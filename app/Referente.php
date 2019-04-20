<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referente extends Model
{
    protected $fillable = [
        'codigo','nombre','apellido','departamento', 'ciudad', 'barrio',
    ];
}
