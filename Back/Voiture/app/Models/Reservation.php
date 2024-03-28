<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'table_reservations';
    protected $fillable = ['voiture','client','prix','status','date_debut','date_fin'];
}
