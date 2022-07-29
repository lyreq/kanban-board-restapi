<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
        
    /**
     * getToken
     * Bu servis ile kullancıya özel bir token verilir. 
     * Bu servisten elde edilen token diğer tüm servislerde gönderilirken Authorization key ile header'a eklenmelidir. 
     * Servisten token elde etmek için email ve password bilgisi json formatında Request URL'ye POST olarak gönderilmelidir.
     *
     * @param  mixed $request
     * @return void
     */
    public function getToken(Request $request)
    {

        $email = $request->json("email");
        if (empty($email)) {
            return response()->json([
                "code" => "027",
                "status" => "fail",
                "message" => "email parametresi gönderilmeli",
            ]);
        }
        $password = $request->json("password");
        if (empty($password)) {
            return response()->json([
                "code" => "028",
                "status" => "fail",
                "message" => "password parametresi gönderilmeli",
            ]);
        }

        if (Auth::attempt(["email" => $email, "password" => $password])) {
            $user = Auth::user();
            $token = $user->createToken("csrfToken")->accessToken;
            return response()->json([
                "status" => "success",
                "message" => "İşlem Başarılı",
                "token" => "Bearer ".$token,
            ]);
        }

        return response()->json([
            "code" => "029",
            "status" => "fail",
            "message" => "Mail adresi veya parola hatalı"
        ]);
    }
}
