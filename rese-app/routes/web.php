<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ホーム画面
Route::get('/', [ShopController::class, 'index']);  

// 検索画面
Route::get('/search', [ShopController::class, 'search']);

// 詳細画面
Route::get('/detail', [ShopController::class, 'detail']);

// 認証
Auth::routes();

// 予約登録
Route::post('/reserve', [ShopController::class, 'reserve'])->middleware('auth');

// 予約変更
Route::post('/update', [ShopController::class, 'update'])->middleware('auth');

// キャンセル
Route::post('/cancel', [ShopController::class, 'cancel'])->middleware('auth');

// 予約完了
Route::get('/thanks', [ShopController::class, 'thanks']);

// お気に入り登録
Route::post('/like', [ShopController::class, 'like']);

// お気に入り削除
Route::post('/dislike', [ShopController::class, 'dislike']);

// マイページトップ画面
Route::get('/mypage/top', [ShopController::class, 'top'])->middleware('auth');

// 予約更新完了
Route::get('/mypage/thanks', [ShopController::class, 'complete_update']);

// 予約キャンセル完了
Route::get('/mypage/cancel', [ShopController::class, 'complete_cancel']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// 評価画面
Route::get('/review', [ShopController::class, 'review']);

// 評価登録画面
Route::post('/review_register', [ShopController::class, 'review_register']);

// 評価完了
Route::get('/mypage/review_thanks', [ShopController::class, 'review_thanks']);

// 評価表示
Route::get('/review_show', [ShopController::class, 'review_show']);