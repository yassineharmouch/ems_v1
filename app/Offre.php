<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = [
    	'titre','description',  'image'
    ];
    
   // public function user(){
   //     return $this->belongsTo('App\User');
   // }

}
