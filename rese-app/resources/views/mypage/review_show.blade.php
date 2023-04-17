@extends('layouts.default')
{{-- <style>
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
</style> --}}
@section('content')
    <div class="container">
            <!-- 評価画面-->
            <div class="row row-cols-1 row-cols-md-3 g-3 m-3">
                @foreach($storereviews as $storereview)
                    <div class="col">
                        <form action="/review_register" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$storereview->getShopName()}}</h5>
                                <div class="row">
                                    <div class="col-12">
                                        @if($storereview->stars=="1")
                                            <label for="star1" style="color: #ffcc00;">★</label>
                                        @elseif($storereview->stars=="2")
                                            <label for="star1" style="color: #ffcc00;">★★</label>
                                        @elseif($storereview->stars=="3")
                                            <label for="star1" style="color: #ffcc00;">★★★</label>
                                        @elseif($storereview->stars=="4")
                                            <label for="star1" style="color: #ffcc00;">★★★★</label>
                                        @elseif($storereview->stars=="5")
                                            <label for="star1" style="color: #ffcc00;">★★★★★★</label>
                                        @else
                                            <label for="star1" style="color: #ffcc00;">☆</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="textarea1">ご感想</label>
                                        <textarea class="form-control my-1" id="textarea1" rows="3" name="comment" disabled>{{$storereview->comment}}</textarea>
                                    </div>
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