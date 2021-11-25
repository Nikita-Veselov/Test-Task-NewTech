<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'adv_id',
        'advertiser',
    ];

    public function blacklist()
    {
        return $this->belongsTo(Blacklist::class, 'adv_id', 'adv_id');
    }
}
