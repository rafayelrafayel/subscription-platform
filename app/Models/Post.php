<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'website_id'
    ];

    protected $casts = [
        'sent' => 'boolean',
    ];



    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
