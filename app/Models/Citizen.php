<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'name', 'telp'
    ];

    public function contents()
    {
        return $this->hasMany(Content::class, 'nik', 'nik');
    }
}
