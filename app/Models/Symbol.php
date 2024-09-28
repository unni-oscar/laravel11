<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    use HasFactory;
     // Specify the table associated with the model if it's not the plural form of the model name
     protected $table = 'symbols';

     // Specify the attributes that are mass assignable
     protected $fillable = ['symbol'];
 
     // Define the relationship to the Bhavcopy model
     public function bhavcopies()
     {
         return $this->hasMany(Bhavcopy::class);
     }
}
