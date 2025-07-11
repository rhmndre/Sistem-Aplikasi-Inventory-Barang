<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ManajemenUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'hak_akses',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mapping hak_akses to role for compatibility
    public function getRoleAttribute()
    {
        return $this->hak_akses;
    }
}
