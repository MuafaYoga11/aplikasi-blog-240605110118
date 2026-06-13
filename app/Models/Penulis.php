<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penulis extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penulis';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'user_name',
        'password',
        'foto',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationship: Penulis has many Artikel
    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_penulis');
    }
}
