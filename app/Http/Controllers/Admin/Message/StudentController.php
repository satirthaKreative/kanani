<?php

namespace App\Http\Controllers\Admin\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Model\Backend\CourseModel;
use App\Model\Backend\CourseAgeModel;
use App\Model\Backend\LearningTypeModel;
use App\Model\Backend\AdminFreeTrailModel;
use App\Model\Backend\Config\FreeTrailConfigModel;
use App\Model\Frontend\FreeTrailBookingModel;
use App\Model\Backend\FreetrailConfigNewModel;
use App\Model\Frontend\Message\MessageModel;
use App\Model\Frontend\Message\Student\StudentAdminMsgModel;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $messageQuery = DB::table('message_tbls')
                        ->select('message_tbls.id','message_tbls.course_name','message_tbls.topic_name','message_tbls.user_type','message_tbls.sender_type','message_tbls.sender_id','message_tbls.receiver_id','message_tbls.message_details','message_tbls.message_tbls_status','users.first_name','users.last_name')
                        ->join('course_tbls','course_tbls.id','=','message_tbls.course_tbls_id')
                        ->join('users','users.id','=','message_tbls.sender_id')
                        ->where(['message_tbls.user_type' => 'admin']) 
                        ->orWhere(['message_tbls.sender_type' => 'admin']) 
                        ->get();
        $studentMsgQuery = StudentAdminMsgModel::where('user_ids','!=',0)->where('msg_view_type','unseen')->get();
        return view('admin.dashboard.pages.student.messages.student-msg',compact('messageQuery','studentMsgQuery'));
    }

    public function show_student_admin_fx(Request $request, $id)
    {
        $messageQuery = DB::table('message_tbls')
                        ->select('message_tbls.id','message_tbls.course_name','message_tbls.topic_name','message_tbls.user_type','message_tbls.sender_type','message_tbls.sender_id','message_tbls.receiver_id','message_tbls.message_details','message_tbls.message_tbls_status','users.first_name','users.last_name')
                        ->join('course_tbls','course_tbls.id','=','message_tbls.course_tbls_id')
                        ->join('users','users.id','=','message_tbls.sender_id')
                        ->where(['message_tbls.id' => base64_decode($id)])
                        ->get();
        $subMessageQuery = StudentAdminMsgModel::where('message_tbls',base64_decode($id))->orderBy('id','DESC')->get();
        return view('admin.dashboard.pages.student.messages.student-admin-msg',compact('messageQuery','subMessageQuery'));
    }

    public function show_student_admin_submit_fx(Request $request)
    {
        $insertArr = [
            "message_tbls" => $request->input('msg_tbl_id_name'), 
            "messages" => $request->input('student_admin_msg_name'), 
            "user_ids" => 0, 
            "created_at" => date('Y-m-d H:i:s'), 
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $insertQuery = StudentAdminMsgModel::insert($insertArr);
        if($insertQuery){
            $request->session()->flash('success_msg','Successfully booked');
        }else{
            $request->session()->flash('error_msg','Something went wrong');
        }
        return redirect()->back();
    }

    # unseen seen
    public function student_message_unseen_seen_fx(Request $request)
    {
        $msg_id = $_GET['msg_id'];
        $updateToSeenQuery = StudentAdminMsgModel::where('user_ids','!=',0)
                                                    ->where('message_tbls',$msg_id)
                                                    ->update(['msg_view_type' => 'seen']);
        $msg = "error";
        if($updateToSeenQuery){
            $msg = "success";
        }
        echo json_encode($msg);
    }
}