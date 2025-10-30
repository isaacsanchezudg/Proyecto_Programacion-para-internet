<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'piso', 'capacidad', 'edificio_id'];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class);
    }
}