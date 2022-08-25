<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Datamodel extends Model
{
    use HasFactory;
    public function getmenu()
    {
            $menu=DB::table('technologies')->select('technology_name','technology_description','id')->whereBetween('id', array(1, 8))->get();
            return ['menu'=>$menu];
            
         
    }

}
