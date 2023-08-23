<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_id', 'step',
    ];

    public function recipestep()
    {
        return $this->belongsTo(recipestep::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

   

}
