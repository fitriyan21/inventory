<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTaking extends Model
{
    protected $table ='inventory_taking';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_code',
        'date',
        'user_id', 
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

    public function inventoryTakingDetail()
    {
        return $this->hasMany(InventoryTakingDetail::class, 'inventory_taking_id', 'id');
    }
}
