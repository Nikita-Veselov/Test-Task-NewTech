<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'publisher_id',
        'site_id',
        'adv_id',
    ];

    public function advertisers()
    {
        return $this->hasMany(Advertiser::class, 'adv_id', 'adv_id');
    }

    public function publishers()
    {
        return $this->hasMany(Publisher::class, 'publisher_id', 'publisher_id');
    }

    public function sites()
    {
        return $this->hasMany(Site::class, 'site_id', 'site_id');
    }
}
