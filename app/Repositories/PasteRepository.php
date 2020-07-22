<?php

namespace App\Repositories;

use App\User;
use App\Paste;

class PasteRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Paste::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();   
    }
    
    public function loadLast()
    {
        return Paste::whereRaw('DATE_ADD(created_at, INTERVAL exp_time MINUTE) >= NOW()')->where('access',0)->orderBy('created_at', 'desc')->limit(10)
                    ->get();
    }
    public function loadUserLast(\App\User $user)
    {
        return Paste::whereRaw('DATE_ADD(created_at, INTERVAL exp_time MINUTE) >= NOW()')->where('user_id',$user->id)->orderBy('created_at', 'desc')->limit(10)
                    ->get();
    }     
    
    public function loadUser(\App\User $user, $page_count=10)
    {
        return Paste::whereRaw('DATE_ADD(created_at, INTERVAL exp_time MINUTE) >= NOW()')
                ->where('user_id',$user->id)
                ->orderBy('created_at', 'desc')
                ->paginate($page_count);
    }      
    public function loadFind($find, $page_count=10)
    {
        return Paste::whereRaw("DATE_ADD(created_at, INTERVAL exp_time MINUTE) >= NOW() AND (name LIKE '%{$find}%' OR text LIKE '%{$find}%') ")
                ->orderBy('created_at', 'desc')
                ->paginate($page_count);
               
    }    
}
