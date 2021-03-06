<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    // Table Name (Default Post)
    protected $table = 'logger';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
