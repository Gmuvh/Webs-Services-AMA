<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sat extends Model {
     protected $table = 'SHMNUC';
     protected  $primaryKey = 'NucCod';
     protected $keyType = 'string';
     //Modifica la clave primaria con caracter
}
