<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttachFile extends Model
{
    protected $fillable = [
        'report_id', 'path'
    ];
}
