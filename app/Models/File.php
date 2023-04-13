<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function samples()
    {
        return $this->belongsToMany(Sample::class, 'sample_files');
    }

    public function sample_files()
    {
        return $this->hasMany(SampleFile::class);
    }
}
