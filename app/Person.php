<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';

    protected $primaryKey = 'person_id';

    public function phone()
    {
        return $this->hasMany('App\Phones','person_id','person_id');
    }
}
