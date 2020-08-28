<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Course;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Justification extends Model
{
    protected $fillable = ['file', 'title', 'description', 'approval', 'start_date', 'end_date', 'user_id'];

    public function user() 
    {
        return $this->belongsTo(User::class);  
    }

    public function upload_file($file)
    {
        $this->file = $file->extension();
        $this->save();

        $file_name = $this->id . '.' . $this->file;
       
        $file->storeAs('uploads/', $file_name, ['disk'=>'public']);

        return $file_name;
    }

    public function getJustificationDates(){

        $begin= $this->start_date; 
        $end= $this->end_date; 

        $period = CarbonPeriod::create($begin, $end);

        $dates = $period->toArray();

        $datesWithoutWeekend = Course::excludeWeekendsFromRange($dates);

        $datesAsString = Course::convertCarbonRangeIntoStringRange($datesWithoutWeekend);

        return $datesAsString;
    }
}

