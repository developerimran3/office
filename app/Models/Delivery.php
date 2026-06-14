<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{

    use SoftDeletes;
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

        //Register Doc Create data
        'be_no',
        'be_date',
        'be_lane',

        //Assessment
        'assessment_date',
        'document',
        'r_no',

        //Delivery
        'delivery_date',
    ];

    protected $casts = [
        'items' => 'array',
        'containers' => 'array',
        'container_locations' => 'array',
        'net_weights' => 'array',
        'item_values' => 'array',
        'item_gross_weights' => 'array',
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
