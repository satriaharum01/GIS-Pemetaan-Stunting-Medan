<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    use HasFactory;
    protected $table = 'puskesmas';
    protected $primaryKey = 'id_puskesmas';
    protected $fillable = ['nama_upt','id_kelurahan'];
    
    public function Kelurahan()
    {
        return $this->belongsTo('App\Models\Kelurahan', 'id_kelurahan','id_kelurahan');
    }
    
}
