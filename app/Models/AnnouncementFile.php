<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementFile extends Model
{
    use HasFactory;
    protected $table = "announcement_files";
    protected $fillable = [
        'announcement_id', 'is_main', 'path'
    ];
    public $timestamps = false;
}
