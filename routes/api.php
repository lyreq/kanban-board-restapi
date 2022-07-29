<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/*
Bu servis ile kullancıya özel bir token verilir. 
Bu servisten elde edilen token diğer tüm servislerde gönderilirken Authorization key ile header'a eklenmelidir.
Servisten token elde etmek için email ve password bilgisi json formatında Request URL'ye POST olarak gönderilmelidir.
*/
Route::post("getToken", "TokenController@getToken")->name("login");

Route::middleware("auth:api")->group(function () {

    Route::get("getBoardList", "BoardController@getBoardList");
    Route::post("setBoardInsert", "BoardController@setBoardInsert");
    Route::post("setBoardUpdate", "BoardController@setBoardUpdate");
    Route::post("setBoardDelete", "BoardController@setBoardDelete");

    Route::get("getTaskList", "TaskListController@getTaskList");
    Route::post("setTaskListInsert", "TaskListController@setTaskListInsert");
    Route::post("setTaskListUpdate", "TaskListController@setTaskListUpdate");
    Route::post("setTaskListDelete", "TaskListController@setTaskListDelete");

    Route::get("getCardList", "CardController@getCardList");
    Route::post("setCardListInsert", "CardController@setCardListInsert");
    Route::post("setCardListUpdate", "CardController@setCardListUpdate");
    Route::post("setCardListDelete", "CardController@setCardListDelete");
});
