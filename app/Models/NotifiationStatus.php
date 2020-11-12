<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifiationStatus extends Model
{
    use HasFactory;

    protected $table = '_notification_status';
    protected $guarded = [];
    protected $hidden = [];
}
