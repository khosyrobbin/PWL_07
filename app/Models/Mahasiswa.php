<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Mahasiswa extends Model
{
    protected $table="mahasiswas";
    public $timestamps= false;
    protected $primaryKey = 'nim';

    protected $fillable = [
        'nim',
        'kelas_id',
        'nama',
        'kelas',
        'jurusan',
        'no_handphone',
        'email',
        'tanggal_lahir'
    ];

    public function kelas(){
        return $this->belongsTo(kelas::class);
    }
};
