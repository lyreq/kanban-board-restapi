<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController as MyFunction;
use App\Models\BoardList;
use App\Models\TaskList;

class TaskListController extends Controller
{
    /**
     * getTaskList
     * Bu servis de get ile yapılan istek sonucunda task listesi geri döndürülür. 
     * Eğer board_id istek ile birlikte gönderilmişse belirtilen board_id'ye göre task list döndürülür
     * Eğer id istek ile birlikte gönderilmişse belirtilen id'ye göre task list bilgisini döndürülür
     *
     * @param  mixed $request
     * @return void
     */
    public function getTaskList(Request $request)
    {
        $tasklistArray = array();
        $row = 0;

        $tasklist = TaskList::all();

        if ($tasklist->count() > 0) {
            $response =  MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
        } else {
            $response =  MyFunction::response("002", "fail", "Task list Kaydı bulunamadı");
        }


        foreach ($tasklist as $key) {

            $tasklistArray[$row]['id'] = $key->id;
            $tasklistArray[$row]['task_title'] = $key->task_title;
            $tasklistArray[$row]['created_at'] = $key->created_at;
            $tasklistArray[$row]['updated_at'] = $key->updated_at;
            $response['boardList'] = $tasklistArray;
            $row++;
        }

        if (isset($request->board_id)) {
            $tasklistArray = array();
            $row = 0;

            $board_id = htmlspecialchars($request->board_id);
            $tasklist = TaskList::where("board_id", $board_id);

            if ($tasklist->count() > 0) {
                $response =  MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
            } else {
                $response =  MyFunction::response("002", "fail", "Task list Kaydı bulunamadı");
            }


            foreach ($tasklist->get() as $key) {

                $tasklistArray[$row]['id'] = $key->id;
                $tasklistArray[$row]['task_title'] = $key->task_title;
                $tasklistArray[$row]['created_at'] = $key->created_at;
                $tasklistArray[$row]['updated_at'] = $key->updated_at;
                $response['taskList'] = $tasklistArray;
                $row++;
            }
        }
        if (isset($request->id)) {
            $tasklistArray = array();
            $row = 0;

            $id = htmlspecialchars($request->id);
            $tasklist = TaskList::where("id", $id);

            if ($tasklist->count() > 0) {
                $response =  MyFunction::response("000", "success", "İşlem Gerçekleştirildi");
            } else {
                $response =  MyFunction::response("002", "fail", "Task list Kaydı bulunamadı");
            }


            foreach ($tasklist->get() as $key) {

                $tasklistArray[$row]['id'] = $key->id;
                $tasklistArray[$row]['task_title'] = $key->task_title;
                $tasklistArray[$row]['created_at'] = $key->created_at;
                $tasklistArray[$row]['updated_at'] = $key->updated_at;
                $response['taskList'] = $tasklistArray;
                $row++;
            }
        }

        return response()->json($response);
    }

    /**
     * setTaskListInsert
     * Bu servis de POST ile yapılan istek sonucunda yeni bir task listesi ekler. board_id ve task_title zorunlu olarak gönderilmelidir.
     *
     * @param  mixed $request
     * @return void
     */
    public function setTaskListInsert(Request $request)
    {
        $board_id = htmlspecialchars($request->board_id);
        if (empty($board_id)) {
            return response()->json(
                [
                    "code" => "019",
                    "status" => "fail",
                    "message" => "board_id gönderilmeli."
                ]
            );
            exit;
        }

        $boardCheck = BoardList::where("id", $board_id)->count();
        if ($boardCheck == 0) {
            return response()->json(
                [
                    "code" => "020",
                    "status" => "fail",
                    "message" => "Board bulunamadı"
                ]
            );
            exit;
        }

        $task_title = $request->task_title;
        if (empty($task_title)) {
            return response()->json(
                [
                    "code" => "021",
                    "status" => "fail",
                    "message" => "task_title gönderilmeli."
                ]
            );
            exit;
        }

        $task = new TaskList();
        $task->board_id = $board_id;
        $task->task_title = $task_title;

        if ($task->save()) {
            return response()->json(
                [
                    "code" => "000",
                    "status" => "success",
                    "message" => "İşlem başarılı."
                ]
            );
            exit;
        }


        return response()->json(
            [
                "code" => "099",
                "status" => "fail",
                "message" => "Entegrasyon Hatası."
            ]
        );
        exit;
    }

    /**
     * setTaskListUpdate
     * Bu servis de POST ile yapılan istek sonucunda id ile gelen task listi düzenler. task_title ve id gönderilmesi zorunludur
     *
     * @param  mixed $requset
     * @return void
     */
    public function setTaskListUpdate(Request $request)
    {
        $tasklist_id = htmlspecialchars($request->id);
        if (empty($tasklist_id)) {
            return response()->json([
                "code" => "022",
                "status" => "fail",
                "message" => "id gönderilmeli"
            ]);
            exit;
        }

        $check = TaskList::where("id", $tasklist_id);
        if ($check->count() == 0) {
            return response()->json([
                "code" => "023",
                "status" => "fail",
                "message" => "Task list bulunamadı"
            ]);
            exit;
        }

        $task_title = $request->task_title;
        if (empty($task_title)) {
            return response()->json([
                "code" => "024",
                "status" => "fail",
                "message" => "task_title gönderilmeli"
            ]);
            exit;
        }
        $check = $check->first();
        $check->task_title = $task_title;
        if ($check->save()) {
            return response()->json([
                "code" => "000",
                "status" => "success",
                "message" => "İşlem başarılı"
            ]);
            exit;
        }

        return response()->json([
            "code" => "099",
            "status" => "fail",
            "message" => "Entegrasyon Hatası"
        ]);
        exit;
    }

    /**
     * setTaskListDelete
     * Bu servis de POST ile yapılan istek sonucunda id ile gelen task listi siler. id gönderilmesi zorunludur
     *
     * @param  mixed $request
     * @return void
     */
    public function setTaskListDelete(Request $request)
    {
        $id = htmlspecialchars($request->id);
        if (empty($id)) {
            return response()->json([
                "code" => "025",
                "status" => "fail",
                "message" => "id gönderilmeli",
            ]);
            exit;
        }

        $check = TaskList::where("id", $id);
        if ($check->count() == 0) {
            return response()->json([
                "code" => "026",
                "status" => "fail",
                "message" => "Kayıt bulunamadı"
            ]);
            exit;
        }

        $delete = $check->delete();
        if ($delete) {
            return response()->json([
                "code" => "000",
                "status" => "success",
                "status" => "İşlem gerçekleştirildi",
            ]);
        }
        return response()->json([
            "code" => "099",
            "status" => "fail",
            "message" => "Entegrasyon Hatası"
        ]);
        exit;
    }
}
