<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    //
    protected $fillable=['user_id','contact'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Licensees(){
        return $this->hasMany('App\Licensee');
    }
}
