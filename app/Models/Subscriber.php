<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'website_id'
    ];
    public $timestamps = false;

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
