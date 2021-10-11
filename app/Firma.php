<?php namespace App;
 
 use Illuminate\Database\Eloquent\Model;
 
 
 class Firma extends Model
 {
	 protected $table = 'Firma';
     protected $fillable = ['Adres', 'AraciNo', 'Izin', 'Kanun', 'KontrolNo', 'SgkUser', 'Sicil', 'Unvan', 'VergiNo'];
 }