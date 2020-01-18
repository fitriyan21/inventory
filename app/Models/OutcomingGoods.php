<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutcomingGoods extends Model
{
    protected $table ='outcoming_goods';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice',
        'customer_id',
        'user_id', 
        'date', 
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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function outcomingGoodsDetail()
    {
        return $this->hasMany(OutcomingGoodsDetail::class, 'outcoming_goods_id', 'id');
    }
}
