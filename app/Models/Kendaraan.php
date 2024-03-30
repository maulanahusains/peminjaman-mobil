<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
  use HasFactory;

  protected $guarded = ['id'];
  public $timestamps = false;

  public function Pemilik()
  {
    return $this->belongsTo(User::class, 'id_user', 'id');
  }

  public function Jenis()
  {
    return $this->belongsTo(JenisKendaraan::class, 'id_jenis', 'id');
  }
}
