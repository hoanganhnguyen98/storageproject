<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    protected $fillable = [
        'receiver_id' ,'report_id', 'status'
    ];
}
