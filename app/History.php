<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    // Table Name (Default Post)
    protected $table = 'history';

    // Primary Key
    public $foreignKey = 'id';

    // Timestamps
    public $timestamps = true;

    public function logger(){
        return $this->belongsTo('App\Logger');
    }
}
