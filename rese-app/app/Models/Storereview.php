<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storereview extends Model
{
    // リレーションシップ
    public function reservation() {// reservationsテーブルへの関連付け
        //引数に指定したモデルへ関連付け 従から主への紐づけ
        return $this->belongsTo('App\Models\reservation');
    }
    // stars, commentカラムにデータの挿入を許可する
    protected $fillable = [
        'reservation_id','stars', 'comment', 
    ];

    public function getShopName()// ショップ名を取得
    {

        return  optional($this->shop)->shop_name;
    }
    
    public function shop()//テーブルへの関連付け
    {
        return $this->belongsTo('App\Models\Shop');//引数に指定したモデルへ関連付け 従から主への紐づけ
    }
    use HasFactory;
}
