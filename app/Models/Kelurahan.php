<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = 'kelurahan';
    protected $primaryKey = 'id_kelurahan';
    protected $fillable = ['nama','id_kecamatan'];

    public function Puskesmas()
    {
        return $this->hasMany('App\Models\Puskesmas', 'id_kelurahan');
    }
    
    public function Kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan', 'id_kecamatan');
    }
}
