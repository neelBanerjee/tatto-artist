<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistData extends Model
{
    use HasFactory;
    protected $table = 'artist_data';

    protected $fillable = ['artist_id','hourly_rate','specialty','years_in_trade','walk_in_welcome','certified_professionals','consultation_available',
        'language_spoken','parking','water_available','coffee_available','mask_worn','vaccinated_staff'
    ];
}
