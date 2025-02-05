<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model; 


class Ticket extends Model
{
    protected $collection = 'tickets';

    protected $fillable = ['ticket_id','title', 'description', 'status'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ticket) {
            $lastTicket = Ticket::orderBy('ticket_id', 'desc')->first();
            $ticket->ticket_id = $lastTicket ? $lastTicket->ticket_id + 1 : 1;
        });
    }
}
