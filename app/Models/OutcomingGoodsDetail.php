<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutcomingGoodsDetail extends Model
{
    protected $table ='outcoming_goods_details';

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outcoming_goods_id',
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

    public function outcomingGoods(){
        return $this->belongsTo(OutcomingGoods::class,'outcoming_goods_id');
    }

}
