<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function stock()
    {
        return $this->belongsTo(RestockItem::class, 'restock_item_id');
    }
}
