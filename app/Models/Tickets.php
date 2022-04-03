<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title' , 'status' , 'importance' , 'post_method' , 'last_message' , 'department_id'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function messages(){
        return $this->hasMany(TicketMessage::class , 'ticket_id');
    }
}
