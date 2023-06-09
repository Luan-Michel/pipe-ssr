<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status_id',
        'organism_id',
        'genome_id',
        'user_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function organism()
    {
        return $this->belongsTo(Organism::class);
    }

    public function genome()
    {
        return $this->belongsTo(Genome::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }

}
