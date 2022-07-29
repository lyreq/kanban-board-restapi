<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController as MyFunction;
use App\Models\Cards;
use App\Models\TaskList;

class CardController extends Controller
{
    /**
     * Bu servis sayesinde get ile yapılan istek sonucunda card listesi döner.
     * Eğer list_id servis'e gönderilirse listeye ait kartlar döner
     * Eğer id servis'e gönderilirse id bilgisine ait kartın bilgileri döner
     * getCardList
     *
     * @param  mixed $request
     * @return void
     */
    public function getCardList(Request $request)
    {
        $cardlistArray = array();
        $row = 0;



        $card = Cards::all();

        if ($card->count() > 0) {
            $response =  MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
        } else {
            $response =  MyFunction::response("009", "fail", "Card Kaydı bulunamadı");
        }

        foreach ($card as $key) {
            $cardlistArray[$row]['id'] = $key->id;
            $cardlistArray[$row]['list_id'] = $key->list_id;
            $cardlistArray[$row]['card_row'] = $key->card_row;
            $cardlistArray[$row]['card_title'] = $key->card_title;
            $cardlistArray[$row]['card_text'] = $key->card_text;
            $cardlistArray[$row]['created_at'] = $key->created_at;
            $cardlistArray[$row]['updated_at'] = $key->updated_at;
            $response['cardList'] = $cardlistArray;
            $row++;
        }




        if (isset($request->list_id)) {

            $cardlistArray = array();
            $row = 0;

            $list_id = htmlspecialchars($request->list_id);
            $card = Cards::where("list_id", $list_id)->orderBy("card_row", "ASC");
            if ($card->count() > 0) {
                $response =  MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
            } else {
                $response =  MyFunction::response("010", "fail", "Card Kaydı bulunamadı");
            }

            foreach ($card->get() as $key) {
                $cardlistArray[$row]['id'] = $key->id;
                $cardlistArray[$row]['list_id'] = $key->list_id;
                $cardlistArray[$row]['card_row'] = $key->card_row;
                $cardlistArray[$row]['card_title'] = $key->card_title;
                $cardlistArray[$row]['card_text'] = $key->card_text;
                $cardlistArray[$row]['created_at'] = $key->created_at;
                $cardlistArray[$row]['updated_at'] = $key->updated_at;
                $response['cardList'] = $cardlistArray;
                $row++;
            }
        }
        if (isset($request->id)) {

            $cardlistArray = array();
            $row = 0;

            $id = htmlspecialchars($request->id);
            $card = Cards::where("id", $id)->orderBy("card_row", "ASC");
            if ($card->count() > 0) {
                $response =  MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
            } else {
                $response =  MyFunction::response("003", "fail", "Card Kaydı bulunamadı");
            }

            foreach ($card->get() as $key) {
                $cardlistArray[$row]['id'] = $key->id;
                $cardlistArray[$row]['list_id'] = $key->list_id;
                $cardlistArray[$row]['card_row'] = $key->card_row;
                $cardlistArray[$row]['card_title'] = $key->card_title;
                $cardlistArray[$row]['card_text'] = $key->card_text;
                $cardlistArray[$row]['created_at'] = $key->created_at;
                $cardlistArray[$row]['updated_at'] = $key->updated_at;
                $response['card'] = $cardlistArray;
                $row++;
            }
        }

        if (isset($request->list_id) && isset($request->id)) {
            $response =  MyFunction::response("011", "fail", "Aynı anda id ve list_id bilgisi gönderilemez");
        }
        return response()->json($response);
    }

    /**
     * setCardListInsert
     * Bu servis sayesinde POST ile yapılan istek sonucunda yeni card eklenir. list_id , card_row , card_title , card_text gönderilmesi zorunludur
     *
     * @param  mixed $request
     * @return void
     */
    public function setCardListInsert(Request $request)
    {
        if (empty($request->list_id)) {
            return response()->json([
                "code" => "",
                "status" => "fail",
                "message" => "list_id gönderilmelidir",
            ]);
            exit;
        }
        $list_id = htmlspecialchars($request->list_id);
        $check = TaskList::where("id", $list_id)->count();
        if ($check == 0) {
            return response()->json([
                "code" => "012",
                "status" => "fail",
                "message" => "Task list id'si hatalı",
            ]);
            exit;
        }

        if (empty($request->card_row)) {
            return response()->json([
                "code" => "013",
                "status" => "fail",
                "message" => "card_row gönderilmelidir",
            ]);
            exit;
        }

        if (empty($request->card_title)) {
            return response()->json([
                "code" => "014",
                "status" => "fail",
                "message" => "card_title gönderilmelidir",
            ]);
            exit;
        }
        if (empty($request->card_text)) {
            return response()->json([
                "code" => "015",
                "status" => "fail",
                "message" => "card_text gönderilmelidir",
            ]);
            exit;
        }

        $card = new Cards();
        $card->list_id = $request->list_id;
        $card->card_row = $request->card_row;
        $card->card_title = $request->card_title;
        $card->card_text = $request->card_text;

        if ($card->save()) {
            return response()->json([
                "code" => "",
                "status" => "success",
                "message" => "İşlem Gerçekleştirildi",
            ]);
            exit;
        }

        return response()->json([
            "code" => "099",
            "status" => "fail",
            "message" => "Entegrasyon hatası",
        ]);
        exit;
    }

    /**
     * setCardListUpdate
     * Bu servis sayesinde POST ile yapılan istek sonucunda card bilgisinin sırası,bulunduğu liste , başlığı veya yazısı düzenlenebilir. id bilgisinin gönderilmesi zorunludur
     * list_id , card_row , card_title, card_text bilgilerinin gönderilmesi opsiyoneldir.
     *
     * @param  mixed $request
     * @return void
     */
    public function setCardListUpdate(Request $request)
    {
        $id = $request->id;
        $check = Cards::where("id", $id);
        if ($check->count() == 0) {
            return response()->json([
                "code" => "016",
                "status" => "fail",
                "message" => "Card bulunamadı",

            ]);
            exit;
        }

        $card = $check->first();
        if (isset($request->list_id)) {
            $card->list_id = $request->list_id;
        }
        if (isset($request->card_row)) {
            $card->card_row = $request->card_row;
        }
        if (isset($request->card_title)) {
            $card->card_title = $request->card_title;
        }

        if (isset($request->card_text)) {
            $card->card_text = $request->card_text;
        }

        if ($card->save()) {
            return response()->json([
                "code" => "000",
                "status" => "success",
                "message" => "İşlem gerçekleştirildi",

            ]);
            exit;
        }
        return response()->json([
            "code" => "099",
            "status" => "fail",
            "message" => "Entegrasyon hatası",

        ]);
        exit;
    }
    
    /**
     * setCardListDelete
     * Bu servis sayesinde POST ile yapılan istek sonucunda card bilgisi silinir. id bilgisinin gönderilmesi zorunludur.
     *
     * @param  mixed $request
     * @return void
     */
    public function setCardListDelete(Request $request)
    {
        if (empty($request->id)) {
            return response()->json([
                "code" => "017",
                "status" => "fail",
                "message" => "id gönderilmelidir.",
            ]);
            exit;
        }

        $id = htmlspecialchars($request->id);

        $check = Cards::where("id", $id);
        if ($check->count() == 0) {
            return response()->json([
                "code" => "018",
                "status" => "fail",
                "message" => "Card bulunamadı.",
            ]);
            exit;
        }

        $delete = $check->delete();
        if ($delete) {
            return response()->json([
                "code" => "000",
                "status" => "success",
                "message" => "İşlem gerçekleştirildi",

            ]);
            exit;
        }
        return response()->json([
            "code" => "099",
            "status" => "fail",
            "message" => "Entegrasyon hatası",

        ]);
        exit;
    }
}
