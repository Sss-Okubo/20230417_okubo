<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <title>Rese</title>
    </head>
    
    <style>
        .liked
        {
            color: pink;
        }
    </style>
    <body>
        <header>
            <!-- トップ固定ナビゲーション -->
            <nav class="navbar navbar-light" style="background-color: cornflowerblue;">
                <div class="container">
                    <div class="d-flex flex-row">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Navbar"     aria-controls="Navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <h1 class=" display-7 mx-2" href="#" style="color:whitesmoke">Rese</h1>
                    </div>
                    @if(Auth::check())
                    <p style="color:whitesmoke">Welcome！{{$user->name.'さん'}}</p>
                    @else
                    <p style="color:whitesmoke">Welcome！ゲストさん</p>
                    @endif
                    <div class="collapse navbar-collapse" id="Navbar" >
                        <ul class="navbar-nav me-auto mb-2 mb-md-0" >
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">ホーム</a>
                            </li>
                            @if(Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/mypage/top">マイページ</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="/register">会員登録</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/login">ログイン</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--メインコンテンツ-->
        <main>@yield('content')</main>
        <!-- フッタ -->
        <footer class="container mt-5">
          <p>&copy; Rese 2023</p>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>