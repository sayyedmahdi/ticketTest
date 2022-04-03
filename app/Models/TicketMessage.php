<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['ticket_id' , 'content' , 'user_email' , 'user_phone' , 'username'];

    public function ticket(){
        return $this->belongsTo(Tickets::class);
    }
}
