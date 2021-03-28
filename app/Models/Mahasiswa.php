<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table="mahasiswa";
    public $timestamps= false;
    protected $primaryKey = 'nim';

    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'no_handphone',
    ];
};
