<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function restock()
    {
        return $this->belongsTo(Restock::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
