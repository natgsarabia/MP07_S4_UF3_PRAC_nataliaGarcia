<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuari extends Model
{
    use HasFactory;

    //definim les relacions per indicar que un mateix usuaris
    //pot tenir diversias comandes

    //desactivem perque no guardi aautomaticament el temps y l'usuari
    public $timestamps = false;

    protected $table = 'usuaris';

    //IMPORTANTE PARA PODER ACTUALIZAR
    protected $fillable = ['nom', 'email', 'edat'];
}
