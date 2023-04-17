@extends('layouts.default')
@section('content')
    <script language="javascript" type="text/javascript">
        function writeResavationDate() { 
            let elm = document.getElementById("resavationDate").value;
            document.getElementById('reserveDateTxt').innerHTML = '<p>'+ elm + "</p>";
        }
        function writeResavationTime() { 
            let elm = document.getElementById("resavationTime").value;
            document.getElementById('reserveTimeTxt').innerHTML = '<p>'+ elm + "</p>";
        }
        function writeResavationNumber() { 
            let elm = document.getElementById("resavationNumber").value;
            document.getElementById('reserveNumberTxt').innerHTML = '<p>'+ elm + "</p>";
        }
        
    </script>
    <div class="container mt-2">
        <!-- 飲食店詳細 -->
        <div class="row row-cols-1 row-cols-md-1 g-2">
            <form action="/reserve" method="post" class="d-flex">
                @csrf
                <div class="col ">
                    <div class ="row">
                        <div class="col-1">
                            <a href="#" class="fas fa-angle-left" onclick="history.back()"></a>
                        </div>
                        <div class="col-11">
                            <h5 class="card-title">{{$item->shop_name}}</h5>
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{$item->image_url}}" class="card-img-top" alt="...">
                        <div class="card-body">                                  
                            <p class="card-text">#{{$item->getAreaName()}} #{{$item->getGenreName()}} </p>
                            <p>{{$item->shop_info}}</p>
                        </div>
                        <input type="hidden" name = "shop_id" value="{{$item->id}}">
                    </div>                          
                </div>
                <div class="col mx-2 container">
                    <div class ="row">
                        <div class="col-sm">
                            <h5 class="card-title">ご予約</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-calendar-alt fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <input type="date" class="form-control" name="resavationDate"  id="resavationDate" value="{{date('Y-m-j')}}" onchange=writeResavationDate()>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-clock fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <select class="form-control" name="resavationTime" id="resavationTime" aria-invalide="false" onchange=writeResavationTime()>
                                <option value="10:00" label="10時00分" selected></option>
                                <option value="11:00" label="11時00分"></option>
                                <option value="12:00" label="12時00分"></option>
                                <option value="13:00" label="13時00分"></option>
                                <option value="14:00" label="14時00分"></option>
                                <option value="15:00" label="15時00分"></option>
                                <option value="16:00" label="16時00分"></option>
                                <option value="17:00" label="17時00分"></option>
                                <option value="18:00" label="18時00分"></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-users fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <select class="form-control" name="resavationNumber"id="resavationNumber" aria-invalid="" onchange=writeResavationNumber()>
                                <option value="1" label="1人" selected></option>
                                <option value="2" label="2人"></option>
                                <option value="3" label="3人"></option>
                                <option value="4" label="4人"></option>
                                <option value="5" label="5人"></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mx-4 my-2  p-4 rounded" style="color:whitesmoke;background-color:cornflowerblue ;width: 95% ">
                            <p><strong> ご予約内容 </strong></p>
                            <div class="row">
                                <p class="col-sm-2">店舗:</p>
                                <p class="col-sm-10">{{$item->shop_name}}</p>
                            </div>
                            <div class="row ">
                                <div class="col-sm-2"><p>日付:</p></div>
                                <div class="col-sm-10" id=reserveDateTxt><p>{{date('Y-m-j')}}</p></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"><p>時間:</p></div>
                                <div class="col-sm-10" id="reserveTimeTxt">10時00分</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2"><p>人数:</p></div>
                                <div class="col-sm-10" id="reserveNumberTxt">1人</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="m-2">
                            <input type="submit" class="btn btn-primary" value="予約する" style="width: 100%">
                            <input type="hidden" name="screen_name" value="detail">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection