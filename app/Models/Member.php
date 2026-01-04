<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'profession',
        'company',
        'linkedin_url',
        'status',
    ];

    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }
}
