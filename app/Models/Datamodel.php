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
            $leftmenu=DB::table('technologies')->select('technology_name','technology_description','id')->whereBetween('id', array(1,11))->get();
            return ['leftmenu'=>$leftmenu];
           
            
         
    }
    public function getmenu2()
    {
            $l_menu=DB::table('technologies')->select('technology_name','technology_description','id')->whereBetween('id', array(12,15))->get();
            return ['l_menu'=>$l_menu];
            
         
    }
    public function get_menu()
    {
            $menu=DB::table('technologies')->select('technology_name','technology_description','id')->whereBetween('id', array(1,15))->get();
            
            return ['menu'=>$menu];
            
         
    }
    

}
