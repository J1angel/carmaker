<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    public function manufacturer()
    {
        return $this->hasOne('App\Models\Manufacturer', 'id', 'manufacturer');
    }

    public function type()
    {
        return $this->hasOne('App\Models\Type', 'id', 'type');
    }
    public function color()
    {
        return $this->hasOne('App\Models\Color', 'id', 'color');
    }
}
