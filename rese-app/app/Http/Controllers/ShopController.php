<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Like;
use App\Models\User;
use App\Models\Storereview;

class ShopController extends Controller
{
    // 初期表示 ###
    public function index()
    {
        $user = Auth::user(); // user情報取得
        $areas = Area :: all(); // areasテーブルから全件取得
        $genres = Genre ::all();  // genresテーブルから全件取得 
        
        $query = Shop::select(['s.*','l.id as like_id']) // shopsテーブルから全件取得
                ->from('shops as s')
                ->join('areas as a',function($join){
                    $join->on('s.area_id','=','a.id');
                })
                ->join('genres as g',function($join){
                    $join->on('s.genre_id','=','g.id');
                });

                if($user == null){
                    $query->leftJoin('likes as l',function($join) use($user){
                        $join->on('s.id','=','l.shop_id')
                        ->where('l.user_id','=',"");
                        });
                }
                else
                {
                    $query->leftJoin('likes as l',function($join) use($user){
                        $join->on('s.id','=','l.shop_id')
                        ->where('l.user_id','=',"{$user->id}");
                        });
                } 
        $shops =  $query->orderBy("id")->get();
        
        $inputs['area'] = "0"; // input初期化
        $inputs['genre'] = "0";
        $inputs['keyword'] = "";

        $param = ['shops' => $shops,'areas' => $areas,'genres' => $genres,'inputs'=>$inputs,'user'=>$user];
        return view('index',$param);    // index.blade.phpを呼び出す
    }

    // 検索
    public function search(Request $request)
    {
        // リクエストパラメータ取得
        $area_id =  $request-> area;   // エリア
        $genre_id = $request-> genre;  // ジャンル
        $keyword = $request-> keyword; // キーワード

        $user = Auth::user();         // user情報取得
        
        $query = Shop::select(['s.*','l.id as like_id']) // 検索クエリ生成
                ->from('shops as s')
                ->join('areas as a',function($join){
                    $join->on('s.area_id','=','a.id');
                })
                ->join('genres as g',function($join){
                    $join->on('s.genre_id','=','g.id');
                });
                if($user == null){
                    $query->leftJoin('likes as l',function($join) use($user){
                        $join->on('s.id','=','l.shop_id')
                        ->where('l.user_id','=',"");
                        });
                }
                else
                {
                    $query->leftJoin('likes as l',function($join) use($user){
                        $join->on('s.id','=','l.shop_id')
                        ->where('l.user_id','=',"{$user->id}");
                        });
                } ;
                //--
                $query->where(function($query) use($keyword){
                $query->where('shop_info','LIKE BINARY',"%{$keyword}%")
                ->orWhere('s.shop_name','LIKE BINARY',"%{$keyword}%")
                ->orWhere('a.area_name','LIKE BINARY',"%{$keyword}%")
                ->orWhere('g.genre_name','LIKE BINARY',"%{$keyword}%");
                });
        
        if($area_id <> "0"){    // エリア
            $query->where('s.area_id','=',"{$area_id}");
        };
        
        if($genre_id <> "0"){   // ジャンル
            $query->where('s.genre_id','=',"{$genre_id}");
        };
        $shops =  $query->orderBy("id")->get();
        // リストボックス用
        $areas = Area :: all();    // Areasテーブルから全件取得
        $genres = Genre ::all();   // Genresテーブルから全件取得
        $inputs = $request->all(); // inputの値を取得
        $user = Auth::user();   // user情報取得                   
        
        $param = ['shops' => $shops,'areas' => $areas,'genres' => $genres,'inputs'=>$inputs,'user'=>$user];

        return view('index',$param);    // index.blade.phpを呼び出す
    }

    // 詳細
    public function detail(Request $request)
    {
        $shop_id =  $request-> shop_id;   // リクエストパラメータ取得
        $item = Shop::with('area','genre')->find($shop_id); // ショップ情報取得
        $user = Auth::user();          // user情報取得            
        $param = ['item' => $item ,'user'=>$user];
         return view('detail',$param);    // detail.blade.phpを呼び出す
    }

    // 予約登録
    public function reserve(Request $request)
    {
        $user = Auth::user();
        $form = $request->all();
        $reservation_date = $form['resavationDate']." ".$form['resavationTime'];
        
        $param = [];
        Reservation::create(['shop_id'=>$form['shop_id'],'reservation_date'=>$reservation_date,'user_id'=>$user->id,'number'=>$form['resavationNumber']]);
        return  redirect('/thanks');  
    }

    // 予約完了
    public function thanks()
    {
        return  view('thanks');  
    }

    // お気に入り登録
    public function like(Request $request)
    {
        // リクエストパラメータ取得
        $area_id =  $request-> area;   // エリア
        $genre_id = $request-> genre;  // ジャンル
        $keyword = $request-> keyword;// キーワード

        $user = Auth::user();
        $form = $request->all();

        Like::create(['shop_id'=>$form['shop_id'],'user_id'=>$user->id]);
        $request->session()->forget('search_info');
        return back();
    }

    // お気に入り削除
    public function dislike(Request $request)
    {
        $id = $request->like_id;
        Like::find($id)->delete();

        if($request -> screen_name =="home"){
            return redirect('/search?area='.$inputs['area'].'&genre='.$inputs['genre'].' &keyword='.$inputs['keyword'] );
        }
        else{
            // user情報取得
            $user = Auth::user(); 

            // 予約一覧取得
            $reservations =  Reservation::with('user','shop')->where('user_id', $user->id)->orderBy("updated_at","desc")->get() ;

            // お気に入り一覧取得
            $query = Like::select(['l.*','a.area_name','g.genre_name','s.shop_name','s.id as shop_id']) 
                ->from('likes as l')
                ->join('shops as s',function($join){
                    $join->on('s.id','=','l.shop_id');
                })
                ->join('areas as a',function($join){
                    $join->on('s.area_id','=','a.id');
                })
                ->join('genres as g',function($join){
                    $join->on('s.genre_id','=','g.id');
                })
                ->where('l.user_id','=',$user->id);
            $likes = $query ->get();

            // 来店履歴一覧取得
            $query = reservation::select(['r.*','s.shop_name','s.id as shop_id','sr.id as storereview_id']) 
                ->from('reservations as r')
                ->join('shops as s',function($join){
                    $join->on('s.id','=','r.shop_id');
                })
                ->leftJoin('storereviews as sr',function($join){
                    $join->on('r.id','=','sr.reservation_id');
                })
                ->where('r.status','=',"1"); // 来店済の予約

            $histories = $query ->get();
            $param = ['user'=>$user,'reservations'=>$reservations,'histories'=>$histories,'likes'=>$likes,'tab_info' =>'like'];
            
            return view('mypage.top',$param);
        }
    }

     // マイページ トップ画面
    public function top()
    {
        $user = Auth::user(); // user情報取得
        // 予約一覧取得
        $reservations =  Reservation::with('user','shop')->where('user_id', $user->id)->orderBy("updated_at","desc")->get() ;

        // お気に入り一覧取得
        $query = Like::select(['l.*','a.area_name','g.genre_name','s.shop_name','s.id as shop_id']) 
                ->from('likes as l')
                ->join('shops as s',function($join){
                    $join->on('s.id','=','l.shop_id');
                })
                ->join('areas as a',function($join){
                    $join->on('s.area_id','=','a.id');
                })
                ->join('genres as g',function($join){
                    $join->on('s.genre_id','=','g.id');
                })
                ->where('l.user_id','=',$user->id);
        $likes = $query ->get();

        // 来店履歴一覧取得
        $query = reservation::select(['r.*','s.shop_name','s.id as shop_id','sr.id as storereview_id']) 
                ->from('reservations as r')
                ->join('shops as s',function($join){
                    $join->on('s.id','=','r.shop_id');
                })
                ->leftJoin('storereviews as sr',function($join){
                    $join->on('r.id','=','sr.reservation_id');
                })
                ->where('r.status','=',"1") // 来店済の予約
                ->where('r.user_id','=',$user->id);

        $histories = $query ->get();

        $param = ['user'=>$user,'reservations'=>$reservations,'histories'=>$histories,'likes'=>$likes,'tab_info'=>'reservation'];
        return view('mypage.top',$param);
    }

    // 予約変更
    public function update(Request $request)
    {
        Reservation::where('id', $request->reservation_id)
        ->update(['reservation_date' => $request->resavationDate ." ".$request->resavationTime
                , 'number' => $request->resavationNumber]);

        return redirect('/mypage/thanks'); 

    }

    // 予約変更完了
    public function complete_update()
    {
        return  view('mypage.thanks',['tab_info' =>'reservation']);  
    }

    // キャンセル
    public function cancel(Request $request)
    {
        Reservation::where('id', $request->reservation_id)
        ->update(['status' => '9']);

        return redirect('/mypage/cancel'); 

    }

    // キャンセル完了
    public function complete_cancel()
    {
        return  view('mypage.cancel',['tab_info' =>'reservation']);  
    }

    // マイページ 評価画面
    public function review(Request $request)
    {
        $user = Auth::user(); // user情報取得 
        $reservationId = $request->reservation_id;
        // 評価対象店舗情報取得
        $query = reservation::select(['r.*','s.shop_name','s.id as shop_id']) 
                ->from('reservations as r')
                ->join('shops as s',function($join){
                    $join->on('s.id','=','r.shop_id');
                })
                ->where('r.id','=',"{$reservationId}"); // 予約ID
        $histories = $query ->get();
        $param = ['histories'=>$histories,'user'=>$user, ];
        return view('mypage.review',$param);        
    }
    
    // 評価登録
    public function review_register(Request $request)
    {
        $reservationId = $request -> reservation_id;
        $stars = ($request->has('stars')) ? $request -> stars : "0";
        $comment =($request->has('comment')) ? $request -> comment : ""; 
        $comment =($request->comment==null) ? "":$request->comment; 

        Storereview::create([
            'reservation_id' => $reservationId,
            'stars' => $stars,
            'comment' => $comment,
        ]);
        return redirect('/mypage/review_thanks');
    }

    // 評価完了
    public function review_thanks()
    {
        return  view('mypage.review_thanks',['tab_info' =>'like']);  
    }

    // 評価登録
    public function review_show(Request $request)
    {
        $reservationId = $request->reservation_id;
        $user = Auth::user(); // user情報取得 
        //dd($reservationId);
        // 評価対象店舗情報取得
        $query = Storereview::select(['sr.*','s.shop_name','s.id as shop_id']) 
                ->from('storereviews as sr')
                ->join('reservations as r',function($join){
                    $join->on('r.id','=','sr.reservation_id');
                })
                ->join('shops as s',function($join){
                    $join->on('s.id','=','r.shop_id');
                })
                ->where('sr.reservation_id','=',"{$reservationId}"); // 予約ID
        $storereviews = $query ->get();
        //dd($storereviews);
        $param = ['storereviews'=>$storereviews,'user'=>$user, ];
        return view('mypage.review_show',$param);        
   }
}
