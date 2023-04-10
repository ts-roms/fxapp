<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
    use HasFactory;

        /**
     * The table associated with the model
     * 
     * @var string
     */
    protected $table = 'other_income';

    public function other_income_category(){
		return $this->belongsTo('App\Models\OtherIncomeCategory','other_income_category_id')->withDefault();
	}

    public function branch(){
		return $this->belongsTo('App\Models\Branch','branch_id')->withDefault();
	}

    public function created_by() {
        return $this->belongsTo('App\Models\User', 'created_user_id')->withDefault();
    }

    public function updated_by() {
        return $this->belongsTo('App\Models\User', 'updated_user_id')->withDefault(['name' => _lang('N/A')]);
    }

    public function getCreatedAtAttribute($value){
		$date_format = get_date_format();
		$time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

    public function getUpdatedAtAttribute($value) {
        $date_format = get_date_format();
        $time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

    public function getOtherIncomeDateAttribute($value) {
        $date_format = get_date_format();
        $time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

}
