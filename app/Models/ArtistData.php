<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistData extends Model
{
    use HasFactory;
    protected $table = 'artist_data';

    protected $fillable = ['artist_id','hourly_rate','specialty','years_in_trade'];
}
