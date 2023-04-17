@extends('layouts.default')
@section('content')
    <!--検索 -->
    <div class="container p-3 p-sm-5">
        <div class="row">
            <form class="d-flex" action="/search" method="get">
                <div class="col-3">
                    <div class=" mx-1">
                        <select class="form-select mb-3" name="area">
                            <option value=0 selected>エリア</option>
                            @foreach($areas as $area)
                                @if($area->id == $inputs['area'])
                                    <option value="{{$area->id}}" selected>{{$area->area_name}}</option>
                                @else
                                    <option value="{{$area->id}}">{{$area->area_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mx-1">
                        <select class="form-select mb-3" name="genre">
                            <option value=0 selected>ジャンル</option>
                                @foreach($genres as $genre)
                                    @if($genre->id == $inputs['genre'])
                                        <option value="{{$genre->id}}" selected>{{$genre->genre_name}}</option>
                                    @else
                                        <option value="{{$genre->id}}">{{$genre->genre_name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3  mx-1">
                        <input type="text" name="keyword" class="form-control" placeholder="キーワードを入力" value="{{$inputs['keyword']}}">
                        <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container mt-2">
        <!-- 飲食店一覧 -->
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($shops as $shop)
                <div class="col">
                    <div class="card">
                        <img src="{{$shop->image_url}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$shop->shop_name}}</h5>
                            <p class="card-text">#{{$shop->getAreaName()}} #{{$shop->getGenreName()}} </p>
                            <div class="row">
                                <div class="col-9">
                                    <form action="/detail" method="get">
                                        <button href="#" class="btn btn-primary">詳しく見る</button>
                                        <input type="hidden" name = "shop_id" value="{{$shop->id}}">
                                    </form>
                                </div>
                                <div class="col-3">
                                    <!--お気に入りボタン -->
                                    @if (Auth::check())
                                        @if ($shop->like_id)
                                            <!--お気に入りから削除 -->
                                            <form action="/dislike" method="POST" class="mb-4" >
                                                <input type="hidden" name="like_id" value="{{$shop->like_id}}">
                                                @csrf
                                                <button type="submit" style="background-color:white; border:none">
                                                    <span class="fa fa-heart liked fa-2x"></span>
                                                </button>
                                                <input type="hidden" name="screen_name" value="home">
                                            </form>
                                        @else
                                            <!--お気に入りに追加 -->
                                            <form action="/like" method="POST" class="mb-4" >
                                                @csrf
                                                <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                                <button type="submit" style="background-color:white;border:none">
                                                    <span class="far fa-heart liked fa-2x"></span>
                                                </button>
                                                <input type="hidden" name="screen_name" value="home">
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
@endsection
