<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomMail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'status', 'send_at','data','subject'
    ];

}
