<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_title',
        'note_content',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
