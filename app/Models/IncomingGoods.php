<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingGoods extends Model
{
    protected $table = 'incoming_goods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice',
        'supplier_id',
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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function incomingGoodsDetail()
    {
        return $this->hasMany(IncomingGoodsDetail::class, 'incoming_goods_id', 'id');
    }
}
