<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTicket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purchase()
    {
        return $this->belongsToMany(Purchase::class);
    }
}
