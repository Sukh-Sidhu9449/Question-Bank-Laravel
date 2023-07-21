<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\navbarTechnologyController;
use Illuminate\Support\Facades\Cookie;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'user') {
            return redirect('/dashboard');
        }
        return view('register');
    }
    public function userRegister(Request $request)

    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:4|string',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);
        if($validator->fails()){
            $response = [
                'message' => $validator->errors()
            ];
            return response()->json($response,409);
        }
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($user->save()) {

            return response()->json(['status' => '200']);
        } else {
            return response()->json(['status' => '404']);
        }
    }
    public function loadlogin()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'user') {
            return redirect('/dashboard');
        }
        return view('login');
    }
    public function userlogin(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'password' => 'required'

        ]);
        if ($request->rememberme === null) {
            Cookie::queue('login_email', $request->email, time() - 60 * 60 * 24 * 100);
            Cookie::queue('login_pass', $request->password, time() - 60 * 60 * 24 * 100);
        } else {
            Cookie::queue('login_email', $request->email, time() + 60 * 60 * 24 * 100);
            Cookie::queue('login_pass', $request->password, time() + 60 * 60 * 24 * 100);
        }
        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {
            $last_login = Auth::user()->last_login;
            session()->put('last_login', $last_login);
            $id = Auth::user()->id;
            date_default_timezone_set("Asia/Calcutta");
            DB::table('users')->where('id', '=', $id)->update(['last_login' => date('Y:m:d H:i:s')]);
            if (Auth::user()->role == 'admin') {
                return response()->json('admin');
            } else {
                return response()->json('user');
            }
        } else {
            return response()->json(['error' => 'invalid credentials']);
        }
    }

    public function index()
    {
        return view('admin.profile');
    }

    public function getProfileData()
    {
        $user_id = Auth::user()->id;
        $query = DB::table('usertechnologies')->where('users_id', '=', $user_id)->get();
        $query = count($query);
        if ($query == 0) {
            $data = DB::table('users as u')
                ->select('u.name', 'u.email', 'u.gender', 'u.address', 'u.image', 'u.designation', 'u.experience', 'u.last_company')
                ->where('u.id', $user_id)
                ->LeftJoin('usertechnologies as ut', 'ut.users_id', '=', 'u.id')
                ->whereNull('ut.users_id')
                ->get();
        } else {
            $data = DB::table('users as u')
                ->join('usertechnologies as ut', 'ut.users_id', '=', 'u.id')
                ->where('u.id', $user_id)
                ->select('u.name', 'u.email', 'u.gender', 'u.address', 'u.image', 'u.designation', 'u.experience', 'u.last_company')
                ->get();
        }
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $data = [
            "name" => $request->profile_name,
            "email" => $request->profile_email,
            "gender" => $request->profile_gender,
            "address" => $request->profile_address,
            "experience" => $request->profile_experience,
            "designation" => $request->profile_designation,
            "last_company" => $request->profile_last_company,
        ];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $uniq_no = mt_rand();
            $unique_image = $uniq_no . 'image' . $filename;
            $move = $file->move(public_path() . '/uploads', $unique_image);
            if ($move) {
                $record = DB::table('users')->where('id', $id)->first();
                $file = $record->image;
                $filename = public_path() . $file;
                \File::delete($filename);
            }
            $data['image'] = "/uploads/" . $unique_image;
        }


        DB::table('users')->where('id', '=', $id)->update($data);


        return redirect()->back()->with('status', 'Profile Update Successfully');
    }
    public function dashboardData()
    {
        $technology = DB::table('technologies')->get();
        $technology = count($technology);
        $user = DB::table('users')->get();
        $user = count($user);
        $questions = DB::table('questions')->get();
        $questions = count($questions);
        $frameworks = DB::table('frameworks')->get();
        $frameworks = count($frameworks);
        return response()->json([
            'technologies' => $technology,
            'users' => $user,
            'questions' => $questions,
            'frameworks' => $frameworks,
        ]);
    }

    public function fetchNotifications()
    {
        $notifications = Db::table('userquizzes as uq')->where('uq.status', 'S')->orWhere('uq.status', 'U')
            ->join('users as u', 'u.id', '=', 'uq.users_id')
            ->join('blocks as b', 'b.id', '=', 'uq.block_id')
            ->select('uq.id', 'uq.status', 'u.name', 'b.block_name', 'uq.submitted_at')
            ->orderBy('uq.id','desc')
            ->get();

        $countNotifications = Db::table('userquizzes as uq')->where('uq.status', 'S')
            ->join('users as u', 'u.id', '=', 'uq.users_id')
            ->join('blocks as b', 'b.id', '=', 'uq.block_id')
            ->select('uq.id', 'uq.status', 'u.name', 'b.block_name', 'uq.submitted_at')
            ->get();
        $count_notifications = count($countNotifications);
        if (count($notifications) > 0) {
            return response()->json(['count_notifications' => $count_notifications, 'notifications' => $notifications, 'status' => 200]);
        } else {
            return response()->json(['count_notifications' => 0, 'status' => 404]);
        }
    }

    public function indexNotification()
    {

        return view('admin.notifications');
    }

    public function notificationPanel()
    {
        $adminId = Auth::user()->id;
        $notificationData = DB::table('userquizzes as uq')
            ->join('blocks as b', 'b.id', '=', 'uq.block_id')
            ->join('users as u', 'u.id', '=', 'uq.users_id')
            ->where('b.admin_id', $adminId)
            ->select('uq.id', 'uq.block_aggregate', 'uq.feedback', 'uq.status','uq.submitted_at', 'b.block_name', 'u.name','uq.email_flag')
            ->orderBy('uq.id','desc')
            ->get();

        return DataTables::of($notificationData)
            ->addIndexColumn()
            ->addColumn('pdf', function ($notificationData) {
                if ($notificationData->block_aggregate == '')
                    return '-';
                else
                    return '<a href="/admin/download-pdf/' . $notificationData->id . '" ><i class="bi bi-cloud-arrow-down-fill downPdf"></i></a> <a href="/admin/view-pdf/' . $notificationData->id . '" target="_blank"><i class="bi bi-eye-fill viewPdf"></i> </a>';
            })
            ->addColumn('mail', function ($notificationData) {
                if ($notificationData->block_aggregate == '')
                    return '-';
                else
                    return '<i class="bi bi-envelope-fill sendMail" data-id=" '. $notificationData->id .'"data-bs-toggle="modal" data-bs-target="#exampleModal"></i></a>';
            })

            ->editColumn('status', function ($notificationData) {
                if ($notificationData->status == 'P')
                    return '<p class="text-black">Pending</p>';
                elseif ($notificationData->status == 'I')
                    return '<p class="text-black">Initiated</p>';
                elseif ($notificationData->status == 'S')
                    return '<p class="text-black">Submitted</p>';
                elseif ($notificationData->status == 'U')
                    return '<p class="text-black">Under Review</p>';
                elseif ($notificationData->status == 'C')
                    return '<p class="text-black">Reviewed</p>';
                elseif ($notificationData->status == 'AR')
                    return '<p class="text-black">Reviewed</p>';
            })

            ->editColumn('block_aggregate', function ($notificationData) {
                if ($notificationData->block_aggregate == '')
                    return '-';
                else
                    return $notificationData->block_aggregate;
            })

            ->editColumn('feedback', function ($notificationData) {
                if($notificationData->block_aggregate == ''){
                    return '-';
                }
                else{
                    if ($notificationData->feedback == ''){
                        return '<i class="bi bi-plus-circle-fill feedbackIcon" data-id="'.$notificationData->id.'"></i>';
                    }
                    else{
                        return $notificationData->feedback;
                    }
                }
            })
            ->editColumn('mail', function ($notificationData) {
                if ($notificationData->email_flag == 0){
                    return '<i class="fa fa-envelope sendEmail" data-id="'.$notificationData->id.'"></i>';
                }else{
                    return '<i class="fa fa-envelope"></i>';
                }

            })

            ->rawColumns(['pdf', 'mail','feedback','status'])
            ->setRowId('id')
            // ->setColumnClass('pdf','pdfColumn')
            // ->setRowClass(function ($adminId) {
            //     return $adminId->id % 2 == 0 ? 'alert-success' : 'alert-primary';
            // })
            ->removeColumn('id')
            ->make(true);
    }

    public function loadDashboard()
    {
        return navbarTechnologyController::newShow();
    }
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function adminlogout(Request $request)
    {
        Cookie::queue(Cookie::forget('login_email'));
        Cookie::queue(Cookie::forget('login_pass'));
        Auth::logout();
        $request->Session()->flush();
        return response()->json(['status' => 200]);
    }
}
