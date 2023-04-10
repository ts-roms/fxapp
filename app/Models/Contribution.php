<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'contributions';

    protected static function booted()
    {
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id')->withDefault();
    }
}
