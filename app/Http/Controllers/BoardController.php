<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardList;
use App\Http\Controllers\ResponseController as MyFunction;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    /**
     * getBoardList
     * Bu serviste GET ile gelen istek sonucunda JSON formatında Board Listesini verir
     * Eğer sadece bir adet board hakkında bilgi almak istiyorsak, id parametresinde ilgili board'ın id'si gönderilmelidir.
     * 
     * @return void
     */
    public function getBoardList(Request $request)
    {
        if (isset($request->id)) {
            $id = htmlspecialchars($request->id);
            $boardlist = BoardList::where("id", $id);
        } else {
            $boardlist = BoardList::all();
        }






        $boardArray = array();
        $row = 0;
        if (isset($request->id)) {
            if ($boardlist->count() == 0) {
                $response = MyFunction::response("001", "fail", "Board Kaydı Bulunamadı");
            } else {
                $response = MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
                $key = $boardlist->first();
                $boardArray[$row]['id'] = $key->id;
                $boardArray[$row]['board_name'] = $key->board_name;
                $boardArray[$row]['created_at'] = $key->created_at;
                $boardArray[$row]['updated_at'] = $key->updated_at;
                $response['boardList'] = $boardArray;
                $row++;
            }
        } else {
            if ($boardlist->count() == 0) {
                $response = MyFunction::response("002", "fail", "Board Kaydı Bulunamadı");
            } else {
                $response = MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
                foreach ($boardlist as $key) {
                    $boardArray[$row]['id'] = $key->id;
                    $boardArray[$row]['board_name'] = $key->board_name;
                    $boardArray[$row]['created_at'] = $key->created_at;
                    $boardArray[$row]['updated_at'] = $key->updated_at;
                    $response['boardList'] = $boardArray;
                    $row++;
                }
            }
        }

        // işlem sonucunu ve işlem sonuç numarasını da cevap ile gönderiyoruz.

        return response()->json($response);
    }

    /**
     * setBoardInsert
     * Bu serviste POST ile gönderilen board_name ile yeni bir board oluşturur
     *
     * @param  mixed $request
     * @return void
     */
    public function setBoardInsert(Request $request)
    {
        $board_name = $request->board_name;
        if (empty($board_name)) {
            return response()->json(MyFunction::response("003", "fail", "board_name gönderilmeli!"));
            exit;
        }
        $board = new BoardList();
        $board->board_name = $board_name;
        $add =  $board->save();
        if ($add) {
            return response()->json(MyFunction::response("000", "success", "İşlem Gerçekleştirildi"));
            exit;
        }
        return response()->json(MyFunction::response("099", "fail", "Entegrasyon hatası."));
        exit;
    }

    /**
     * setBoardUpdate
     * Bu serviste POST ile gönderilen board_id numaralı board'ın adını değiştirir
     * 
     * @param  mixed $request
     * @return void
     */
    public function setBoardUpdate(Request $request)
    {
        $board_name = $request->board_name;
        $board_id = htmlspecialchars($request->board_id);
        if (empty($board_name)) {
            return response()->json(MyFunction::response("004", "fail", "board_name gönderilmeli!"));
            exit;
        }
        if (empty($board_id)) {
            return response()->json(MyFunction::response("005", "fail", "board_id gönderilmeli!"));
            exit;
        }
        $board =  BoardList::where("id", $board_id);
        if ($board->count() == 0) {
            return response()->json(MyFunction::response("006", "fail", "board bulunamadı"));
            exit;
        }

        $board = $board->first();

        $board->board_name = $board_name;
        $update =  $board->save();
        if ($update) {
            return response()->json(MyFunction::response("000", "success", "İşlem Gerçekleştirildi"));
            exit;
        } else {
            return response()->json(MyFunction::response("099", "fail", "Entegrasyon hatası."));
            exit;
        }
    }

    /**
     * setBoardDelete
     * Bu serviste POST ile gönderilen board_id numaralı board'ı kalıcı olarak siler
     * 
     * @param  mixed $request
     * @return void
     */
    public function setBoardDelete(Request $request)
    {
        $board_id = htmlspecialchars($request->board_id);
        if (empty($board_id)) {
            return response()->json(MyFunction::response("007", "fail", "board_id gönderilmeli!"));
            exit;
        }
        $board =  BoardList::where("id", $board_id);
        if ($board->count() == 0) {
            return response()->json(MyFunction::response("008", "fail", "board bulunamadı"));
            exit;
        }

        $delete =  $board->delete();
        if ($delete) {
            return response()->json(MyFunction::response("000", "success", "İşlem Gerçekleştirildi"));
            exit;
        } else {
            return response()->json(MyFunction::response("099", "fail", "Entegrasyon hatası."));
            exit;
        }
    }
}
