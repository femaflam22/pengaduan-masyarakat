<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Citizen;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'nik', 'message', 'image', 'status'
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class, 'nik', 'nik');
    }
}
