<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function ticket()
    {
        return $this->hasMany(PurchaseTicket::class);
    }
}
