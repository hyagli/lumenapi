<?php namespace App;
 
 use Illuminate\Database\Eloquent\Model;
 
 
 class FirmaLog extends Model
 {
	 protected $table = 'FirmaLog';
     protected $fillable = ['FirmaId', 'UserId'];
 }