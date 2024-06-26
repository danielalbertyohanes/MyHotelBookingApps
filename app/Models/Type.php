<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;

    // public $timestamp = false;

    public  function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class, 'type_id', 'id'); // hasmany buat many karena 1 hotel bisa banyak product
    }
}
