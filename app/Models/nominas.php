<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nominas extends Model
{
    use HasFactory;
    protected $primaryKey ='idn';
    protected $fillable = ['idn','fecha','dias','monto','ide'];
}