<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    // Relacion de muchos a uno
    public function users() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function hours() {
        return  $this->belongsTo('App\Models\Hour', 'hour_id');
    }
    
}
