<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class empleados extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey ='ide';
    protected $fillable = ['ide','nombre','apellido','sexo','idd','descripcion',
                            'email','celular','edad','salario','img'];
}
