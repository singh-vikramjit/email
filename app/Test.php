<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
