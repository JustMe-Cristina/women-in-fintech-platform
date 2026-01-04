<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    protected $fillable = ['title', 'story', 'member_id'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
