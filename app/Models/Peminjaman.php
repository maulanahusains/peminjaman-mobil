<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  public function PenanggungJawab()
  {
    return $this->belongsTo(User::class, 'penanggung_jawab', 'id');
  }

  public function Kendaraan()
  {
    return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
  }
}
