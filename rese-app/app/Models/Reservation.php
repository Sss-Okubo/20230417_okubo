<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable =['user_id','shop_id','reservation_date','number'];

    public function getShopName()// ショップ名を取得
    {

        return  optional($this->shop)->shop_name;
    }

    public function getImageUrl()// 画像のURLを取得
    {

        return  optional($this->shop)->image_url;
    }

    public function user()//テーブルへの関連付け
    {
        return $this->belongsTo('App\Models\User');//引数に指定したモデルへ関連付け 従から主への紐づけ
    }
    
    public function shop()//テーブルへの関連付け
    {
        return $this->belongsTo('App\Models\Shop');//引数に指定したモデルへ関連付け 従から主への紐づけ
    }

    // リレーションシップ
    public function reviews() { //

        //関連付け 主から従への紐づけ
        return $this->hasMany('App\Models\storereview');
        
    }
}
