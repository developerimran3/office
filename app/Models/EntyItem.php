<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntyItem extends Model
{
    use HasFactory;

    protected $fillable = ['enty_id', 'goods_name', 'item_quantity', 'net_weight', 'item_value'];

    public function enty()
    {
        return $this->belongsTo(Enty::class, 'enty_id');
    }
}
