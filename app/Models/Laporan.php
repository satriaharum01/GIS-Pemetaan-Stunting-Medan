<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = ['id_puskesmas','tahun','sasaran','jumlah','sangat_pendek','pendek','normal'];

    public function Puskesmas()
    {
        return $this->belongsTo('App\Models\Puskesmas', 'id_puskesmas','id_puskesmas');
    }
}
