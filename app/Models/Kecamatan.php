<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $primaryKey = 'id_kecamatan';
    protected $fillable = ['nama'];

    public function Kelurahan()
    {
        return $this->hasMany('App\Models\Kelurahan', 'id_kecamatan');
    }
}
