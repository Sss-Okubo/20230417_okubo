@extends('layouts.default')
@section('content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                @if($tab_info == "reservation")
                    <a href="#reservations" class="nav-link active" data-bs-toggle="tab">予約状況</a>
                @else
                    <a href="#reservations" class="nav-link" data-bs-toggle="tab">予約状況</a>
                @endif
            </li>
            <li class="nav-item">
                @if($tab_info == "like")
                    <a href="#likes" class="nav-link active" data-bs-toggle="tab">お気に入り店舗</a>
                @else
                    <a href="#likes" class="nav-link" data-bs-toggle="tab">お気に入り店舗</a>
                @endif
            </li>
            <li class="nav-item">
                @if($tab_info == "history")
                    <a href="#histories" class="nav-link active" data-bs-toggle="tab">来店履歴</a>
                @else
                    <a href="#histories" class="nav-link" data-bs-toggle="tab">来店履歴</a>
                @endif
            </li>
        </ul>
        <!--タブの中身 -->
        <div class="tab-content">
            @if($tab_info == "reservation")
                <div id="reservations" class="tab-pane active">
            @else
                <div id="reservations" class="tab-pane">
            @endif
                <!-- 予約一覧-->
                @if (count($reservations)    == 0)
                    <p class="mt-5"><strong> 予約がありません。 </strong></p>
                @endif
                <div class="row row-cols-md-2">
                    @foreach($reservations as $reservation)                   
                        <div class="row">
                        <div class="m-4  p-4 rounded" style="color:whitesmoke;background-color:cornflowerblue ;width: 95% ">
                            <form action="/update" method="post" >
                            @csrf
                            <p><strong> ご予約 {{$loop->index +1}} </strong></p>
                                <input type="hidden" name = "reservation_id" value="{{$reservation->id}}">
                            <div class="row">
                                <p class="col-sm-2">店舗:</p>
                                <p class="col-sm-10"><strong> {{$reservation->getShopName()}}</strong></p>
                            </div>
                            <div class="row ">
                                <div class="col-sm-2"><p>日付:</p></div>
                                {{-- <div class="col-sm-10"><p>{{substr($reservation->reservation_date,0,10)}}</p></div> --}}
                                @if($reservation ->status=="9" || $reservation ->status=="1")
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="resavationDate"  id="resavationDate" value="{{substr($reservation->reservation_date,0,10)}}" onchange=writeResavationDate() readonly>
                                    </div>
                                @else
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="resavationDate"  id="resavationDate" value="{{substr($reservation->reservation_date,0,10)}}" onchange=writeResavationDate() >
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-2"><p>時間:</p></div>
                                {{-- <div class="col-sm-10">{{substr($reservation->reservation_date,11,5)}}</div> --}}
                                <div class="col-sm-10">
                                    @if($reservation ->status=="9" || $reservation ->status=="1")
                                        <select class="form-control" name="resavationTime" id="resavationTime" aria-invalide="false" onchange=writeResavationTime() disabled>
                                    @else
                                        <select class="form-control" name="resavationTime" id="resavationTime" aria-invalide="false" onchange=writeResavationTime()>
                                    @endif
                                        @if(substr($reservation->reservation_date,11,5)=="10:00")
                                            <option value="10:00" label="10時00分" selected></option>
                                        @else
                                            <option value="10:00" label="10時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="11:00")
                                            <option value="11:00" label="11時00分" selected></option>
                                        @else
                                            <option value="11:00" label="11時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="12:00")
                                            <option value="12:00" label="12時00分" selected></option>
                                        @else
                                            <option value="12:00" label="12時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="13:00")
                                            <option value="13:00" label="13時00分" selected></option>
                                        @else
                                            <option value="13:00" label="13時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="14:00")
                                            <option value="14:00" label="14時00分" selected></option>
                                        @else
                                            <option value="14:00" label="14時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="15:00")
                                            <option value="15:00" label="15時00分" selected></option>
                                        @else
                                            <option value="15:00" label="15時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="16:00")
                                            <option value="16:00" label="16時00分" selected></option>
                                        @else
                                            <option value="16:00" label="16時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="17:00")
                                            <option value="17:00" label="17時00分" selected></option>
                                        @else
                                            <option value="17:00" label="17時00分"></option>
                                        @endif
                                        @if(substr($reservation->reservation_date,11,5)=="18:00")
                                            <option value="18:00" label="18時00分" selected></option>
                                        @else
                                            <option value="18:00" label="18時00分"></option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"><p>人数:</p></div>
                                {{-- <div class="col-sm-10">{{$reservation->number}}人</div> --}}
                                <div class="col-sm-10">
                                    @if($reservation ->status=="9" || $reservation ->status=="1")
                                        <select class="form-control" name="resavationNumber"id="resavationNumber" aria-invalid="" onchange=writeResavationNumber() disabled>
                                    @else
                                        <select class="form-control" name="resavationNumber"id="resavationNumber" aria-invalid="" onchange=writeResavationNumber()>
                                    @endif
                                        @if($reservation->number =="1")
                                            <option value="1" label="1人" selected></option>
                                        @else
                                            <option value="1" label="1人"></option>
                                        @endif
                                        @if($reservation->number =="2")
                                            <option value="2" label="2人" selected></option>
                                        @else
                                            <option value="2" label="2人"></option>
                                        @endif
                                        @if($reservation->number =="3")
                                            <option value="3" label="3人" selected></option>
                                        @else
                                            <option value="3" label="3人"></option>
                                        @endif
                                        @if($reservation->number =="4")
                                            <option value="4" label="4人" selected></option>
                                        @else
                                            <option value="4" label="4人"></option>
                                        @endif
                                        @if($reservation->number =="5")
                                            <option value="5" label="5人" selected></option>
                                        @else
                                            <option value="5" label="5人"></option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            @if($reservation->status =="9")
                                <div class="row my-3 text-warning">
                                <p>すでにキャンセルされています。</p>
                                </div>
                            @elseif($reservation->status =="1")
                                <div class="row my-3 text-warning">
                                <p>ご来店ありがとうございました。</p>
                                </div>
                            @else
                            <div class="row">
                                <div class="my-2">
                                    <input type="submit" class="btn btn-primary" value="変更する" style="width: 100%">
                                </div>
                            </div>
                            </form>
                            <form action="/cancel" method="post" >
                                @csrf
                            <div class="row">
                                <div>
                                    <input type="submit" class="btn btn-light" value="キャンセルする" style="width: 100%">
                                    <input type="hidden" name = "reservation_id" value="{{$reservation->id}}">
                                </div>
                            </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- お気に入り店舗-->
            @if($tab_info == "like")
                <div id="likes" class="tab-pane active">
            @else
                <div id="likes" class="tab-pane">
            @endif
                @if (count($likes)    == 0)
                    <p class="mt-5"><strong> お気に入り店舗がありません。 </strong></p>
                @endif
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach($likes as $like)
                        <div class="col">
                            <div class="card">
                                <img src="{{$like->getImageUrl()}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$like->getShopName()}}</h5>
                                    <p class="card-text">#{{$like->area_name}} #{{$like->genre_name}}</p>
                                    <div class="row">
                                        <div class="col-9">
                                            <form action="/detail" method="get">
                                                <button href="#" class="btn btn-primary">詳しく見る</button>
                                                <input type="hidden" name = "shop_id" value="{{$like->shop_id}}">
                                            </form>
                                        </div>
                                        <div class="col-3">
                                            <!--お気に入りボタン -->
                                            @if (Auth::check())
                                                @if ($like->id)
                                                    <!--お気に入りから削除 -->
                                                    <form action="/dislike" method="POST"   class="mb-4" >
                                                        @csrf
                                                        <input type="hidden" name="like_id" value="{{$like->id}}" >
                                                            
                                                        <button type="submit"   style="background-color:white; border:none">
                                                            <span class="fa fa-heart liked fa-1x"></span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <!--お気に入りに追加 -->
                                                    <form action="/like" method="POST"  class="mb-4" >
                                                        @csrf
                                                        <input type="hidden" name="shop_id" value="{{$like->shop_id}}">
                                                        <button type="submit" style="background-color:white;border:none">
                                                            <span class="far fa-heart liked fa-1x"></span>
                                                        </button>
                                                        <input type="hidden" name="screen_name" value="mypage">
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- 履歴一覧-->
            @if($tab_info == "histoty")
                <div id="histories" class="tab-pane active">
            @else
                <div id="histories" class="tab-pane">
            @endif
                @if (count($histories)    == 0)
                    <p class="mt-5"><strong> ご来店履歴がありません。 </strong></p>
                @endif
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    @foreach($histories as $history)
                        <div class="col">
                            <div class="card">
                                <img src="{{$history->getImageUrl()}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$history->getShopName()}}</h5>
                                    <div class="row">
                                        <div class="col-sm-1 m-2" >
                                            <i class="fas fa-calendar-alt fa-1x primary" style="color:cornflowerblue"></i>
                                        </div>
                                        <div class="col-sm m-2">
                                            {{substr($history->reservation_date,0,10)}}" 
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1 m-2" >
                                            <i class="fas fa-clock fa-1x primary" style="color:cornflowerblue"></i>
                                        </div>
                                        <div class="col-sm m-2">
                                            {{substr($history->reservation_date,11,5)}}
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-1 m-2" >
                                            <i class="fas fa-users fa-1x primary" style="color:cornflowerblue"></i>
                                        </div>
                                        <div class="col-sm m-2">
                                            {{$history->number}}
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($history-> storereview_id == null)
                                            <form action="/review" method="get">
                                                <button href="#" class="btn btn-info">評価する</button>
                                                <input type="hidden" name = "reservation_id" value="{{$history->id}}">
                                            </form>
                                            @else
                                            <form action="/review_show" method="get">
                                                <button href="#" class="btn btn-light">評価を見る</button>
                                                <input type="hidden" name = "reservation_id" value="{{$history->id}}">
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection