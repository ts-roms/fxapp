<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomFieldsMeta extends Model
{

    /**
     * The table associated with the model
     * 
     * @var string
     */

    protected $table = 'custom_fields_meta';

    protected static function booted()
    {
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id')->withDefault();
    }
}
