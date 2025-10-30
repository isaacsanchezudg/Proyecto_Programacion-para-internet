<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Edificio.php
class Edificio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'direccion', 'pisos'];

    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }
}

// app/Models/Aula.php
class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'piso', 'capacidad', 'edificio_id'];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }
}