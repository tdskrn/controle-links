<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            $section->slug = Str::slug($section->name);
        });

        static::updating(function ($section) {
            $section->slug = Str::slug($section->name);
        });
    }

    public function links()
    {
        return $this->hasMany(UsefulLink::class);
    }
}