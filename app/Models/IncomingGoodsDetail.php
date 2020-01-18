<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingGoodsDetail extends Model
{
    protected $table ='incoming_goods_details';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'incoming_goods_id',
        'product_id',
        'qty', 
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

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function incomingGoods(){
        return $this->belongsTo(IncomingGoods::class,'incoming_goods_id');
    }
}
