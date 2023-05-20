<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'carender_link',
        'time_slots', // 追加する
        'weekday_slots',
        'is_holiday',
    ];

    public function appoint(){
        return $this->hasMany(Appoint::class);
    }

}
