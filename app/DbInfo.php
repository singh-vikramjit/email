<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DbInfo extends Model
{

	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'db_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
