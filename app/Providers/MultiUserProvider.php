<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class MultiUserProvider extends EloquentUserProvider
{
    public function retrieveById($identifier)
    {
        // Try User model first
        $user = parent::retrieveById($identifier);
        
        if (!$user) {
            // If not found, try ManajemenUser model
            $user = \App\Models\ManajemenUser::find($identifier);
        }
        
        return $user;
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) || !isset($credentials['email'])) {
            return null;
        }

        // Try User model first
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            // If not found, try ManajemenUser model
            $user = \App\Models\ManajemenUser::where('email', $credentials['email'])->first();
        }
        
        return $user;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];
        
        return app('hash')->check($plain, $user->getAuthPassword());
    }
} 