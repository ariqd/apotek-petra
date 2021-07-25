<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $guarded = ['id'];

    public function restocks()
    {
        return $this->hasMany(RestockItem::class);
    }
}
