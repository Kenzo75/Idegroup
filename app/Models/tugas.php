<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tugas extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function hasilTugas()
    {
        return $this->hasOne(HasilTugas::class);
    }
    public function getSelesaiAttribute($value)
    {
        return Carbon::parse($value);
    }
}
