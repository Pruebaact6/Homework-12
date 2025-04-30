<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'name',
        'classification',
        'release_date',
        'review',
        'season',
        'image_path',
        'user_id'
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
