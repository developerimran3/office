<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntyContainer extends Model
{
    use HasFactory;

    protected $fillable = ['enty_id', 'container_no', 'container_size', 'container_location'];

    public function enty()
    {
        return $this->belongsTo(Enty::class, 'enty_id');
    }
}
