<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class ReplyUserMessage extends Model
{
    use HasFactory;

    protected $table = 'admin_reply_messages';
    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }
}
