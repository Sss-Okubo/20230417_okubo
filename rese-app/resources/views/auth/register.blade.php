@extends('layouts.default')
@section('content')
<div class="container mt-4 p-4 border border-primary" style="width: 30%">
    <!-- 会員登録 -->
    <div class="row row-cols-1 row-cols-md-1 g-1">
        <form action="{{ route('register') }}" method="POST" class="d-flex">
        @csrf
            <div class="col mx-2 container">
                <div class="row">
                    <div class=" rounded text-primary" style="color:whitesmoke;width: 95% ">
                        <h5 class="card-title text-center">会員登録</h5>
                    </div>
                    <!-- 名前-->
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-user fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="お名前">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!--email -->
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-envelope fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <!-- パスワード-->
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-lock fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">
                            <p>英字の大文字・小文字・数字から3種類以上を組み合わせて、8文字以上にしてください。</p>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="m-2">
                            <input type="submit" class="btn btn-primary" value="登録する" style="width: 100%">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection