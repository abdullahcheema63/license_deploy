<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licensee extends Model
{
    //
    protected $fillable=['first_name','last_name','emirate_id','dob','status','area','inspector_id','remarks','requirement_1','requirement_2','requirement_3'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Inspector(){
        return $this->belongsTo('App\Inspector');
    }
}
