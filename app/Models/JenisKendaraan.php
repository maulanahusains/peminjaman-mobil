<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKendaraan extends Model
{
  use HasFactory;

  protected $table = 'jenis_kendaraan';

  protected $guarded = ['id'];

  public $timestamps = false;

  public function Jenis()
  {
    return $this->hasMany(JenisKendaraan::class, 'id_jenis', 'id');
  }
}
