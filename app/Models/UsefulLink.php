<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsefulLink extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'name', 'image', 'url'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}