<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Received extends Model
{
    protected $fillable = [
        'importer_name',
        'vessel',
        'total_quantity',
        'bl_no',
        'pkgs_code',
        'lc_number',
        'lc_date',
        'gross_weight',
        'arrival_date',
        'items',
        'containers',

        'document_receiver',
        'rot_no',

        'invoice_value',
        'invoice_no',
        'invoice_date',
    ];

    protected $casts = [
        'items' => 'array',
        'containers' => 'array',
        'container_locations' => 'array',
        'net_weights' => 'array',
    ];

    public function items()
    {
        return $this->hasMany(EntyItem::class, 'enty_id', 'id');
    }

    public function containers()
    {
        return $this->hasMany(EntyContainer::class, 'enty_id', 'id');
    }
}
