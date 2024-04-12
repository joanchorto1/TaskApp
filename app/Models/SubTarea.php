<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTarea extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'tarea_id', 'completada'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

}

