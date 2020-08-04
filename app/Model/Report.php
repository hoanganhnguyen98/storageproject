<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'sender_id', 'report_number', 'title', 'sign_date', 'type'
    ];
}
