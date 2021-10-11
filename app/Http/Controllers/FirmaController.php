<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use Illuminate\Http\Request;
use App\Firma;
use App\FirmaLog;
use App\UserFirma;
use App\Hata;

class FirmaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Giris(Request $request)
    {
		$firma = Firma::where('SgkUser', $request->input('SgkUser'))->first();
		if(!$firma)
			return $this->Hata('Tanımlanmamış firma.');
		
		$userFirma = UserFirma::where('FirmaId', $firma->id)->where('UserId', Auth::user()->id)->where('Aktif', '1')->first();
		if(!$userFirma)
			return $this->Hata('Kullanıcının firmaya izni yok.' . Auth::user()->Email . ' : FirmaId : ' . $firma->id . ' : ' . $firma->Unvan);
		
        $firmaLog = new FirmaLog;
		$firmaLog->UserId = Auth::user()->id;
		$firmaLog->FirmaId = $firma->id;
		$firmaLog->save();
        
		return $this->Basari($firma);
    }
	
	public function Gunle(Request $request)
    {
		$firma = Firma::findOrFail($request->input('Id'));
		
		$firma->Adres = $request->input('Adres');
		$firma->AraciNo = $request->input('AraciNo');
		$firma->KontrolNo = $request->input('KontrolNo');
		$firma->Sicil = $request->input('Sicil');
		$firma->Unvan = $request->input('Unvan');
		$firma->VergiNo = $request->input('VergiNo');
		$firma->save();
		
		return $this->Basari(['mesaj' => 'Kaydedildi.']);
	}
	
	public function Ekle(Request $request)
    {
		if((Auth::user()->id != 1) && (Auth::user()->id != 2))
			return $this->Hata('İzinsiz deneme');

		$firma = Firma::where('SgkUser', $request->input('SgkUser'))->first();
		$sonuc = "";
		
		if($firma)
		{
			$sonuc = 'Firma zaten var. ';
		}
		else
		{		
			$firma = new Firma;
			$firma->SgkUser = $request->input('SgkUser');
			$firma->Izin = 1;
			$firma->save();
			$sonuc = "Firma eklendi. ";
		}

		$userFirma = UserFirma::where('UserId', $request->input('SgkUser'))->where('FirmaId', $firma->id)->first();

		if($userFirma)
		{
			$sonuc = 'Yetki zaten var.';
		}
		else
		{
			$userFirma = new UserFirma;
			$userFirma->UserId = $request->input('UserId');
			$userFirma->FirmaId = $firma->id;
			$userFirma->Aktif = 1;
			$userFirma->save();
			$sonuc = 'Yetki eklendi.';
		}
		
		return $this->Basari(['mesaj' => $sonuc]);
    }
}
