<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'proyecto_id','fecha', 'completada'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function subTareas()
    {
        return $this->hasMany(SubTarea::class);
    }
}
