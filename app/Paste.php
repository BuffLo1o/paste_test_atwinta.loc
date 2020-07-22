<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    protected $fillable = ['name','text'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /*
     * Генерирование уникальной короткой ссылки длиной от 1 до 13 символов
     */
    public function GenerateLink($length=8)
    {
        if($length>13) $length=13;
        if($length<1) $length=1;
        $pos = 13-$length;
        $link = substr(uniqid(), $pos);
        while(Paste::where('link','=',$link)->count() > 0)
            $link = substr(uniqid(), $pos);
        return $link;
    }
}
