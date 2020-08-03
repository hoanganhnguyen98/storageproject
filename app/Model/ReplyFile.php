<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReplyFile extends Model
{
    protected $fillable = [
        'replier_id', 'report_id', 'path'
    ];
}
