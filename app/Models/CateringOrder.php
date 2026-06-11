<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateringOrder extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'no_whatsapp',
        'email',
        'jenis_acara',
        'jumlah_tamu',
        'tanggal_acara',
        'budget',
        'preferensi_menu',
        'catatan_tambahan',
    ];
}