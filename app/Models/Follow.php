<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /** @use HasFactory<\Database\Factories\FollowsFactory> */
    use HasFactory;

    protected $guarded = [
      'follower_id',
      'following_id',
      'follower_following_unique',
    ];
}
