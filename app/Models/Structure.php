<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Structure extends Model
{
public function structure()
    {
        return $this->hasMany(Structure::class);
    }

}