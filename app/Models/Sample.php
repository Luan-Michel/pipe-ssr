<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'library_type_id',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function library_type()
    {
        return $this->belongsTo(LibraryType::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'sample_files');
    }

    public function sample_files()
    {
        return $this->hasMany(SampleFile::class);
    }

}
