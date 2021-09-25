<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Отношение многие ко многим пользователей к группам
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
