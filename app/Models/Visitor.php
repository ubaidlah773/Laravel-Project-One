<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    // Visitor.php
    protected $fillable = [
        'nik', 
        'visitor_name', 
        'person_visited_name', 
        'visit_date',
        'queue_number' 
    ];

    // Mengubah kolom tanggal menjadi objek Carbon secara otomatis
    protected $casts = [
        'visit_date' => 'date',
    ];
}