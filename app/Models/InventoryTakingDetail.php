<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTakingDetail extends Model
{
    protected $table = 'inventory_taking_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_taking_id',
        'product_id',
        'initial_qty',
        'final_qty',
        'difference',
        'note',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
