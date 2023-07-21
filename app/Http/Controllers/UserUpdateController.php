<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserUpdateController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $popularTechnologies = tech_user_Controller::fetchHeaderData();
        $technologies = tech_user_Controller::fetchTechWithFramework();
        // $technologies = DB::table('technologies')->whereBetween('id', [1, 10])->get();
        $users = DB::table('users')->where('id', $id)->get();
        //dd($users);
        //$user = App\User::where('id',$id)->first();
        

        return view('user_edit', ['users' => $users, 'popularTechnologies' => $popularTechnologies,'technologies' => $technologies]);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $data = [
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'last_company' => $request->input('last_company'),
            'designation' => $request->input('designation'),
            'experience' => $request->input('experience'),

        ];
        // $image=$request->input('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $uniq_no = mt_rand();
            $unique_image = $uniq_no . 'image' . $filename;
            $move = $file->move(public_path() . '/img', $unique_image);
            if ($move) {
                $record = DB::table('users')->where('id', $id)->first();
                $file = $record->image;
                $filename = public_path() . $file;
                File::delete($filename);
            }
            $data['image'] = "/img/" . $unique_image;
        }

        DB::table('users')
            ->where('id', '=', $id)
            ->update($data);

        $technologies_id = $request->userTechnology;
        if (!empty($technologies_id)) {
            foreach ($technologies_id as $technology) {
                if ($technology != "") {
                    $technology_data[] = array(
                        'users_id' => $id,
                        'technology_id' => $technology
                    );
                }
            }
            $existingTechnologies=DB::table('usertechnologies')->where('users_id', $id)->get();
            if(count($existingTechnologies)>0){
                $deleteQuery = DB::table('usertechnologies')->where('users_id', $id)->delete();
            }
            DB::table('usertechnologies')->insert($technology_data);
        }
        return redirect('/user_edit');
    }

    public function updatePassword(Request $request)
    {

        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
           // dd('old_password');
            return back()->with("error", "Old Password Doesn't match!");
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status",'Password has been Updated');
    }
}
