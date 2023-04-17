<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    // protected $fillable =['shop_name','area_id','genre_id','shop_info','image_url'];
    
    public function getAreaName()// エリア名を取得
    {
        //optionalメソッドを使用して
        //$this->areaがnullでないときにだけAreaモデルのarea_nameプロパティの値を返す

        return  optional($this->area)->area_name;
    }

     public function getGenreName()// ジャンル名を取得
    {
        //optionalメソッドを使用して
        //$this->geenreがnullでないときにだけGenreモデルのgenre_nameプロパティの値を返す

        return  optional($this->genre)->genre_name;
    }

    public function area()//Areasテーブルへの関連付け
    {
        return $this->belongsTo('App\Models\Area');//引数に指定したモデルへ関連付け 従から主への紐づけ
    }
    
    public function genre()//Genresテーブルへの関連付け
    {
        return $this->belongsTo('App\Models\Genre');//引数に指定したモデルへ関連付け 従から主への紐づけ
    }

}
