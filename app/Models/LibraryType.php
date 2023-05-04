<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }
}
