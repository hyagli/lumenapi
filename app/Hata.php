<?php namespace App;
 
 use Illuminate\Database\Eloquent\Model;
 
 
 class Hata extends Model
 {
	 protected $table = 'Hata';
     protected $fillable = ['Tur', 'Mesaj'];
 }