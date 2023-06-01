<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parameter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value', 'description'];

    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\ParameterFactory::new();
    }
}
