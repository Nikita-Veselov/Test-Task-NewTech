<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'publisher_id',
        'publisher',
    ];

    public function blacklist()
    {
        return $this->belongsTo(Blacklist::class, 'publisher_id', 'publisher_id');
    }
}
