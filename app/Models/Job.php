<?php

namespace App\Models;

// Imports

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//  Eloquent models extending Model class
class Job extends Model
{
    use HasFactory;
    protected $table = 'job_listings';

    protected $fillable = ['title', 'salary', 'employer_id'];
    // Disable fillable fields
    // protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
}
