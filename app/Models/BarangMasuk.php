<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'tanggal',
        'barang',
        'jumlah_barang',
        'jumlah_masuk',
        'satuan',
        'supplier',
        'keterangan',
        'harga_satuan',
        'total_harga',
        'status',
        'approved_by',
        'approved_at',
        'created_by',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'harga_satuan' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    // Relationship dengan User untuk approved_by
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    // Relationship dengan User untuk created_by
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Scope untuk filter berdasarkan tanggal
    public function scopeFilterByDate(Builder $query, $startDate = null, $endDate = null)
    {
        if ($startDate) {
            $query->where('tanggal', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('tanggal', '<=', $endDate);
        }
        return $query;
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk filter berdasarkan bulan
    public function scopeByMonth(Builder $query, $month, $year = null)
    {
        $year = $year ?? Carbon::now()->year;
        return $query->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
    }

    // Scope untuk filter berdasarkan tahun
    public function scopeByYear(Builder $query, $year)
    {
        return $query->whereYear('tanggal', $year);
    }

    // Helper method untuk mendapatkan status dalam bahasa Indonesia
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ];
        return $labels[$this->status] ?? $this->status;
    }

    // Helper method untuk mendapatkan total nilai dari semua item
    public static function getTotalValueByPeriod($startDate, $endDate)
    {
        return self::filterByDate($startDate, $endDate)
                   ->byStatus('approved')
                   ->sum('total_harga');
    }

    // Helper method untuk mendapatkan total qty dari semua item
    public static function getTotalQtyByPeriod($startDate, $endDate)
    {
        return self::filterByDate($startDate, $endDate)
                   ->byStatus('approved')
                   ->sum('jumlah_masuk');
    }
}
