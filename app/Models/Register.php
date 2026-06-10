<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
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



    // protected static function booted()
    // {
    //     /*
    //     |--------------------------------------------------------------------------
    //     | BE CREATE / UPDATE (FIRST TIME)
    //     |--------------------------------------------------------------------------
    //     */
    //     static::saved(function ($register) {

    //         if (
    //             $register->be_no &&
    //             $register->be_date &&
    //             $register->net_weight &&
    //             !$register->bond_adjusted
    //         ) {
    //             $bond = Bond::where(
    //                 'goods_name',
    //                 $register->goods_name
    //             )->first();

    //             if (!$bond) return;

    //             // minus
    //             $newUsed = $bond->used + $register->net_weight;
    //             $newBalance = $bond->availability - $newUsed;

    //             if ($newBalance < 0) {
    //                 throw new \Exception('Bond balance exceeded');
    //             }

    //             $bond->update([
    //                 'used' => $newUsed,
    //                 'balance' => $newBalance,
    //             ]);

    //             // prevent double minus
    //             $register->updateQuietly([
    //                 'bond_adjusted' => true
    //             ]);
    //         }
    //     });

    //     /*
    //     |--------------------------------------------------------------------------
    //     | BE EDIT (net_weight change)
    //     |--------------------------------------------------------------------------
    //     */
    //     static::updating(function ($register) {

    //         if (
    //             $register->bond_adjusted &&
    //             $register->isDirty('net_weight')
    //         ) {
    //             $bond = Bond::where(
    //                 'goods_name',
    //                 $register->goods_name
    //             )->first();

    //             if (!$bond) return;

    //             // rollback old weight
    //             $bond->used -= $register->getOriginal('net_weight');

    //             // apply new weight
    //             $bond->used += $register->net_weight;
    //             $bond->balance = $bond->availability - $bond->used;

    //             if ($bond->balance < 0) {
    //                 throw new \Exception('Bond balance exceeded');
    //             }

    //             $bond->save();
    //         }
    //     });

    //     /*
    //     |--------------------------------------------------------------------------
    //     | BE DELETE → ROLLBACK
    //     |--------------------------------------------------------------------------
    //     */
    //     static::deleting(function ($register) {

    //         if ($register->bond_adjusted) {
    //             $bond = Bond::where(
    //                 'goods_name',
    //                 $register->goods_name
    //             )->first();

    //             if (!$bond) return;

    //             $bond->used -= $register->net_weight;
    //             $bond->balance = $bond->availability - $bond->used;
    //             $bond->save();
    //         }
    //     });
    // }
}
