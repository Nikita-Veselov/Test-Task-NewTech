<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'site_id',
        'site',
    ];
    public function blacklist()
    {
        return $this->belongsTo(Blacklist::class, 'site_id', 'site_id');
    }
}
