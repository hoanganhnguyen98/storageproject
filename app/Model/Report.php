<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'sender_id', 'title', 'sign_date', 'type'
    ];
}
