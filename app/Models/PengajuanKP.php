<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanKP extends Model
{
    protected $fillable = ['npm', 'semester', 'tujuan_instansi', 'status', 'judul_laporan', 'dosen_id'];
}
