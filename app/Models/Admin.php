<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    protected $appends = ['avatar_image_url'];

    public function getAvatarImageUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        } else {
            return '';
        }
    }
}
