<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto'; 

    protected $primaryKey = 'id_producto';

    protected $fillable = ['nombre', 'precio', 'cantidad']; 

    public $timestamps = false; // Desactivar las marcas de tiempo
}
