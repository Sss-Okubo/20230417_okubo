@extends('layouts.default')
<style>
.rate-form {
  display: flex;
  flex-direction: row-reverse;
  justify-content: flex-end;
}
.rate-form input[type=radio] {
  display: none;
}
.rate-form label {
  position: relative;
  /* padding: 0 5px; */
  color: #ccc;
  cursor: pointer;
  font-size: 30px;
}
.rate-form label:hover {
  color: #ffcc00;
}
.rate-form label:hover ~ label {
  color: #ffcc00;
}
.rate-form input[type=radio]:checked ~ label {
  color: #ffcc00;
}
</style>
@section('content')
    <div class="container">
            <!-- 評価画面-->
            <div class="row row-cols-1 row-cols-md-3 g-3 m-3">
                @foreach($histories as $history)
                    <div class="col">
                        <form action="/review_register" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$history->getShopName()}}</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="rate-form">
                                            <input id="star5" type="radio" name="stars" value="5">
                                            <label for="star5">★</label>
                                            <input id="star4" type="radio" name="stars" value="4">
                                            <label for="star4">★</label>
                                            <input id="star3" type="radio" name="stars" value="3">
                                            <label for="star3">★</label>
                                            <input id="star2" type="radio" name="stars" value="2">
                                            <label for="star2">★</label>
                                            <input id="star1" type="radio" name="stars" value="1">
                                            <label for="star1">★</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="textarea1">ご感想をお聞かせ下さい。</label>
                                        <textarea class="form-control my-1" id="textarea1" rows="3" name="comment"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <button href="#" class="btn btn-info my-1">評価する</button>
                                    <input type="hidden" name = "reservation_id" value="{{$history->id}}">
                                </div>
                                <div class="row">
                                    <a href="#" class="btn btn-secondary my-1" onclick="history.back()">戻る</a>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection