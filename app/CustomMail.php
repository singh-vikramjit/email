<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomMail extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_mailing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'status', 'send_at','data','subject'
    ];

}
