<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\UserLog;
use Log;

class UserController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('auth:api');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'User' => 'required',
            'Pass' => 'required'
        ]);
        $user = User::where('Email', $request->input('User'))->first();
		if(!$user)
			return $this->Hata('Hatalı kullanıcı adı veya parola');
		
		if($user->Aktif != '1')
			return $this->Hata('Kullanıcı pasif');
        
        if (!Hash::check($request->input('Pass'), $user->Password)) 
			return $this->Hata('Hatalı kullanıcı adı veya parola.');
		
        $apikey = $this->GiveApiKey($user, $request->ip());
        return $this->Basari(['api_key' => $apikey, 'UserId' => $user->id]);
    }
	
	private function GiveApiKey(User $user, string $ip)
	{
		$apikey = base64_encode(str_random(48));
		$user->api_key = $apikey;
		$user->save();
        $userLog = new UserLog;
		$userLog->UserId = $user->id;
		$userLog->IP = $ip;
		$userLog->save();
		return $apikey;
	}
}
