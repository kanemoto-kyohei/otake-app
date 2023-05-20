<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoint extends Model
{
    use HasFactory;
    //database名を複数形にしなかったので、ここで明示的に示す必要あり
    protected $table = 'appoint';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class, 'carender_link', 'carender_link');
    }

}
