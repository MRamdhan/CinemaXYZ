<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    function user() {
        return $this->belongsTo(User::class);
    }
}
