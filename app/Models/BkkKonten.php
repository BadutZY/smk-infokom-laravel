<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BkkKonten extends Model
{
    protected $table = 'bkk_konten';

    protected $fillable = [
        'apa_itu',
        'ig_nama', 'ig_foto', 'ig_username', 'ig_bio',
        'ig_kiriman', 'ig_pengikut', 'ig_diikuti', 'ig_url',
    ];
}