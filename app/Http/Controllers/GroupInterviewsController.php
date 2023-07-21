<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\GroupInterviews;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mail;

class GroupInterviewsController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            $groupInterviews = GroupInterviews::get();
            $data = [];
            foreach ($groupInterviews as $groupInterview) {
                $block = Block::find($groupInterview->block_id);
                $admin = User::find($block->admin_id);
                $assignee = User::find($groupInterview->assigned_by);
                $questions = DB::table('block_questions')->select('question_id')->where('block_id', $groupInterview->block_id)->get();
                $questionCount = count($questions);
                $interviewData = [
                    'groupInterviewId' => $groupInterview->id,
                    'blockName' => $block->block_name,
                    'questionCount' => $questionCount,
                    'createdBy' => $admin->name,
                    'assignedBy' => $assignee->name,
                    'totalCandidates' => $groupInterview->total_candidates,
                    'passCandidates' => $groupInterview->pass_candidates,
                ];
                // dd($interviewData);
                // $userData = json_decode($user->group_users);
                $data = [...$data, $interviewData];
            }
            // dd($data);
            return view('admin.groupInterviewStats', ['groupData' => $data]);
        } else {
            $groupInterview = GroupInterviews::find($id);
            $block = Block::find($groupInterview->block_id);
            $admin = User::find($block->admin_id);
            // dd($admin->name);
            $assignee = User::find($groupInterview->assigned_by);
            $data = [
                'groupInterviewId' => $groupInterview->id,
                'blockName' => $block->block_name,
                'createdBy' => $admin->name,
                'assignedBy' => $assignee->name,
                'totalCandidates' => $groupInterview->total_candidates,
                'passCandidates' => $groupInterview->pass_candidates,
                'groupUsers' => json_decode($groupInterview->group_users),
            ];
            // dd($groupInterview);
            return view('admin.groupBlockDetail', ['groupData' => $data]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'emails' => 'required',
                'id' => 'required',
            ]);
            if ($validator->fails()) {
                $response = [
                    'message' => $validator->errors()
                ];
                return response()->json(['response' => $response, 'code' => 422]);
            }
            $groupInterview = GroupInterviews::find($request->id);
            $groupUsers = $groupInterview->group_users;
            $decodedGroupUsers = json_decode($groupUsers, true);
            // dd($decodedGroupUsers);
            $date = Carbon::now();
            $date->addDays(2);

            $users = json_decode($request->emails, true);
            $data = [];
            $i = 0;
            $groupData = [];
            foreach ($users as $user) {
                $check =  in_array($user, array_column($decodedGroupUsers, 'email'));
                // dd($check);
                if (!$check) {
                    // dd("!check");
                    $i++;
                    $data = [
                        'email' => $user,
                        'subject' => 'Interview Scheduled',
                    ];
                    $jsonData = [
                        'email' => $user,
                        'id' => '',
                        'name' => '',
                        'interviewStatus' => '',
                        'interviewResult' => '',
                        'date' => $date,
                    ];
                    $groupData = [...$groupData, $jsonData];
                    $urlData = [
                        'userEmail' => $user,
                        'blockId' => $groupInterview->block_id,
                        'date' => $date,
                    ];
                    $toEncryptData = json_encode($urlData);
                    $encrypt = base64_encode($toEncryptData);
                    // dd($encrypt);

                    $userData = [
                        'name' => "Someone",
                        'encrypt' => $encrypt,
                    ];
                    
                    $mail = Mail::send('emails.interviewEmail', ['userData'=>$userData], function ($message) use ($data) {
                        $message->from('qb@yopmail.com', env('App_NAME'));
                        $message->to($data['email']);
                        $message->subject($data['subject']);
                    });
                }
            }
            $groupData = [...$decodedGroupUsers, ...$groupData];
            $jsonGroupData = json_encode($groupData);
            $groupInterview->group_users = $jsonGroupData;
            $groupInterview->total_candidates += $i;
            $groupInterview->save();
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        // return response()->json([
        //     'message' => "mails sent successfully",
        //     'code' => 200
        // ]);
    }

    public function resendEmail(Request $request)
    {
        try {
            $groupInterview = GroupInterviews::find($request->groupInterviewId);
            $groupData = $groupInterview->group_users;
            $decodedGroupUsers = json_decode($groupData, true);
            $date = Carbon::now();
            $date->addDays(2);
            $decodedGroupUsers[$request->userIndex]['interviewStatus'] = 'Pending';
            $decodedGroupUsers[$request->userIndex]['date'] = $date;
            $jsonGroupData = json_encode($decodedGroupUsers);
            $groupInterview->group_users = $jsonGroupData;
            // dd($decodedGroupUsers);
            $groupInterview->save();
            $data = [
                'email' => $decodedGroupUsers[$request->userIndex]['email'],
                'subject' => 'Interview Scheduled',
            ];
            $urlData = [
                'userEmail' => $decodedGroupUsers[$request->userIndex]['email'],
                'blockId' => $groupInterview->block_id,
                'date' => $date,
            ];
            $toEncryptData = json_encode($urlData);
            $encrypt = base64_encode($toEncryptData);
            // dd($encrypt);

            $userData = [
                'name' => $decodedGroupUsers[$request->userIndex]['name']?$decodedGroupUsers[$request->userIndex]['name']:"",
                'encrypt' => $encrypt,
            ];
            $mail = Mail::send('emails.interviewEmail', ['userData'=>$userData], function ($message) use ($data) {
                $message->from('qb@yopmail.com', env('App_NAME'));
                $message->to($data['email']);
                $message->subject($data['subject']);
            });
            // dd($decodedGroupUsers[$request->userIndex]['interviewStatus']);
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
    }

    public function edit(GroupInterviews $groupInterviews)
    {
        //
    }

    public function update(Request $request, GroupInterviews $groupInterviews)
    {
        //
    }

    public function destroy(GroupInterviews $groupInterviews)
    {
        //
    }
}
