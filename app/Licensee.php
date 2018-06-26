<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licensee extends Model
{
    //
    protected $fillable=['first_name','last_name','emirate_id','dob','status','area','inspector_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Inspector(){
        return $this->belongsTo('App\Inspector');
    }
}
