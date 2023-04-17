<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable =['user_id','shop_id'];
    
    public function getShopName()// ショップ名を取得
    {
        return  optional($this->shop)->shop_name;
    }
    public function getImageUrl()// URLを取得
    {
        return  optional($this->shop)->image_url;
    }

    public function user(){
        return $this->belongsTo('App\Models\User');//関連付け 従から主への紐づけ
    }
        
    public function shop()//Genresテーブルへの関連付け
    {
        return $this->belongsTo('App\Models\Shop');//引数に指定したモデルへ関連付け 従から主への紐づけ
    }
}