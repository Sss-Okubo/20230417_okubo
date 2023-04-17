@extends('layouts.default')
@section('content')
    <div class="container mt-4 p-4 border border-primary" style="width: 30%">
        <!-- ログイン -->
        <div class="row row-cols-1 row-cols-md-1 g-1">
            <form method="POST" action="{{ route('login') }}" class="d-flex">
                @csrf
                <div class="col mx-2 container">
                    <div class="row">
                        <div class=" rounded text-primary" style="color:whitesmoke;width: 95% ">
                            <h5 class="card-title text-center">ログイン</h5>
                        </div>
                    </div>
                    <!-- Email-->
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-envelope fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!--パスワード -->
                    <div class="row">
                        <div class="col-sm-1 m-2" >
                            <i class="fas fa-lock fa-2x primary" style="color:cornflowerblue"></i>
                        </div>
                        <div class="col-sm m-2">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="passwaord">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- ログインする-->
                    <div class="row">
                        <div class="m-2">
                            <input type="submit" class="btn btn-primary" value="ログインする" style="width: 100%">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection