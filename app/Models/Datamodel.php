<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Datamodel extends Model
{
    use HasFactory;
//     public function getmenu()
//     {
//             $leftmenu=DB::table('technologies')->select('technology_name','technology_description','id')->whereBetween('id', array(1,13))->get();
//             return ['leftmenu'=>$leftmenu];
           
            
         
//     }
//     public function getmenu2()
//     {
//             $l_menu=DB::table('technologies')->select('technology_name','technology_description','id')->whereBetween('id', array(12,15))->get();
//             return ['l_menu'=>$l_menu];
            
         
//     }
//     public function getmenu3()
//     {
//             $s_menu=DB::table('technologies')->select('technology_name','technology_description','id')->whereBetween('id', array(1,15))->get();
            
//             return ['s_menu'=>$s_menu];
            
         
//     }
    

}
