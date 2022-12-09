<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogMessages extends Model
{
    use HasFactory;

    protected $table = 'log_messages';

    protected $fillable = [
        'level_name',
        'level',
        'message',
        'context',
    ];
}
