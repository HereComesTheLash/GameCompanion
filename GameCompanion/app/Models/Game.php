<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_name',
        'game_description',
        'cover_image_path',
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
