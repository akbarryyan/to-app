<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'tryout_id',
    ];

    /**
     * Relasi ke model Tryout
     */
    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }

    /**
     * Relasi ke model Question (soal-soal dalam kategori)
     */
    // public function questions()
    // {
    //     return $this->hasMany(Question::class);
    // }
}
