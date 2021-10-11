<?php

namespace App\Http\Controllers;

use App\Hata;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function Hata($mesaj)
	{
		$this->HataLogla($mesaj);
		return response()->json(['durum' => 500, 'mesaj' => $mesaj], 500);
	}
	
    protected function Basari($data)
	{
		$result = ['durum' => 0];
		if(is_array($data))
			$result = array_merge($result, $data);
		elseif(method_exists($data, 'toArray'))
			$result = array_merge($result, $data->toArray());
		else
			$result[] = $data;
		return response()->json($result, 200);
	}

    public function HataLogla($mesaj)
    {
		// TODO: Add info about request (User, IP, etc..)
        $hata = new Hata;
        $hata->Tur = 'Hata';
        $hata->Mesaj = $mesaj;
        $hata->save();
    }
}
