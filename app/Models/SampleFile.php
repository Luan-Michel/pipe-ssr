<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id',
        'file_id',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
