<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class DevUserProvider extends EloquentUserProvider
{
    public function retrieveById($identifier): ?Authenticatable
    {
        return $this->createModel()
            ->newQueryWithoutScopes()
            ->find($identifier);
    }

    public function retrieveByToken($identifier, $token): ?Authenticatable
    {
        return $this->createModel()
            ->newQueryWithoutScopes()
            ->where($this->createModel()->getKeyName(), $identifier)
            ->where($this->createModel()->getRememberTokenName(), $token)
            ->first();
    }
}