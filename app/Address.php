<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = ['address_line','city','state','zip','country','phone','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
