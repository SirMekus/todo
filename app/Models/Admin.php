<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'metadata'
    ];

    protected $casts = [
        'name'=>'array',
        'metadata'=>'array',
        'nationality'=>'array',
        'residence'=>'array',
    ];

    protected $appends = ['is_super_admin', 'account_status'];

    public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

    public function getIsSuperAdminAttribute()
    {
        if($this->attributes['role'] == 'super_admin')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getAccountStatusAttribute()
    {
        return $this->attributes['active'] >= 1 ? 'active' : 'deactivated';
    }
    
    public function isSuperAdmin()
    {
        return $this->attributes['role'] == 'super_admin';
    }
}