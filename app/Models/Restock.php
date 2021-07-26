<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(RestockItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
