<?php

namespace App\Http\Controllers\Front\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Frontend\Message\Tutor\TutorMessageModel;

class TutorMessageController extends Controller
{
    # constructor for tutor message
    public function __construct(Request $request){
        $this->middleware('auth:teacher');
    }
    public function show_assign_course(Request $request){
        $tutorQuery = DB::table('assign_tutors_tbls')->where('teacher_id',Auth::guard('teacher')->user()->id)->get();
        $html_assign_tutor = '<option value="">Choose a student name & course name </option>'; 
        foreach($tutorQuery as $tutorQ){
            $student_id = $tutorQ->student_id;
            $course_id = $tutorQ->course_id;
            # course name
            $getCourseQuery = DB::table('course_tbls')->where('id',$course_id)->get();
            foreach($getCourseQuery as $getCourseQ){
                $course_name = " ( ".ucwords($getCourseQ->topic_name)." : ".ucwords($getCourseQ->course_name)." )";
            }
            # teacher name
            $getTutorQuery = DB::table('users')->where('id',$student_id)->get();
            foreach($getTutorQuery as $getTutorQ){
                $tutor_name = ucwords($getTutorQ->first_name)." ".ucwords($getTutorQ->last_name);
            }
            $html_assign_tutor .= '<option value='.$tutorQ->id.'>'.$tutor_name.$course_name.'</option>';
        }
        echo json_encode($html_assign_tutor);
    }
    # show index page
    public function tutor_course_submit_fx(Request $request){
        $assign_tutor_tbl_id = $request->input('student_course_name');
        $message_details = $request->input('message_name');

        $tutorQuery = DB::table('assign_tutors_tbls')->where('id',$assign_tutor_tbl_id)->get();
        foreach($tutorQuery as $tutorQ){
            $student_id = $tutorQ->student_id;
            $course_id = $tutorQ->course_id;
            # course name
            $getCourseQuery = DB::table('course_tbls')->where('id',$course_id)->get();
            foreach($getCourseQuery as $getCourseQ){
                $course_name = $getCourseQ->topic_name;
                $topic_name = $getCourseQ->course_name;
            }
            # teacher name
            $getTutorQuery = DB::table('users')->where('id',$student_id)->get();
            foreach($getTutorQuery as $getTutorQ){
                $tutor_name = ucwords($getTutorQ->first_name)." ".ucwords($getTutorQ->last_name);
            }
        }

        $insertArr = [
            'course_tbls_id' => $course_id,
            'course_name' => $course_name, 
            'topic_name' => $topic_name,
            'user_type' => 'teacher', 
            'teacher_id' => Auth::guard('teacher')->user()->id, 
            'sender_id' => Auth::guard('teacher')->user()->id, 
            'receiver_id' => $student_id, 
            'sender_type' => 'teacher', 
            'message_details' => $message_details, 
            'message_tbls_status' => 'active', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insertQuery = TutorMessageModel::insert($insertArr);
        if($insertQuery){
            $request->session()->flash('success_msg','Successfully tutor message');
        }else{
            $request->session()->flash('error_msg','Something went wrong! Try again later');
        }
        return redirect()->back();
    }

    public function load_sent_message_fx(Request $request){
        $selectQuery = TutorMessageModel::where(['sender_type' => 'teacher', 'sender_id' => Auth::guard('teacher')->user()->id])
        ->orderBy('updated_at','DESC')
        ->get();
        
        if(count($selectQuery) > 0){
            $html['tutor_msg'] = "";
            foreach($selectQuery as $sQuery){
                $getUserQuery = DB::table('users')
                                    ->where('id',$sQuery->receiver_id)
                                    ->get();
                foreach($getUserQuery as $getUserQ){
                    $user_name = ucwords($getUserQ->first_name).' '.ucwords($getUserQ->last_name);
                }
                if(strlen($sQuery->message_details) > 80){
                    $message_details = substr(ucwords($sQuery->message_details),0,80)."...";
                }else{
                    $message_details = ucwords($sQuery->message_details);
                }
                $html['tutor_msg'] .= '<tr >
                                            <td class="txt">'.strtoupper($sQuery->course_name).'<br/><sub> ('.ucwords($sQuery->topic_name).' )</sub></td>
                                            <td class="txt">'.$user_name.'</td>
                                            <td class="txt"><p>'.$message_details.'</p>
                                            </td>
                                            <td class="tm">'.date('Y-m-d',strtotime($sQuery->updated_at)).'<br/>'.date('h:i A',strtotime($sQuery->updated_at)).'</td>                        
                                        </tr>';
            }
        }else{
            $html['tutor_msg'] = '<tr>
                                    <td colspan=4 class="text-danger"><center><i class="fa fa-times"></i> No message sent</center></td>                        
                                </tr>';
        }
        echo json_encode($html);
    }

    public function load_inbox_message_fx(Request $request){
        $selectQuery = TutorMessageModel::where('sender_type','<>','teacher')
        ->orderBy('updated_at','DESC')
        ->get();
        
        if(count($selectQuery) > 0){
            $html['inbox_msg'] = "";
            foreach($selectQuery as $sQuery){
                $getUserQuery = DB::table('users')
                                    ->where('id',$sQuery->receiver_id)
                                    ->get();
                foreach($getUserQuery as $getUserQ){
                    $user_name = ucwords($getUserQ->first_name).' '.ucwords($getUserQ->last_name);
                }
                if(strlen($sQuery->message_details) > 80){
                    $message_details = substr(ucwords($sQuery->message_details),0,80)."...";
                }else{
                    $message_details = ucwords($sQuery->message_details);
                }
                if($sQuery->message_tbls_status == "active"){
                    $message_status_class = "active-class";
                }else if($sQuery->message_tbls_status == "inactive"){
                    $message_status_class = "inactive-class";
                }
                $html['inbox_msg'] .= '<tr class="'.$message_status_class.'" >
                                            <td class="txt">'.strtoupper($sQuery->course_name).'<br/><sub> ('.ucwords($sQuery->topic_name).' )</sub></td>
                                            <td class="txt">'.$user_name.'</td>
                                            <td class="txt"><p>'.$message_details.'</p>
                                            </td>
                                            <td class="tm">'.date('Y-m-d',strtotime($sQuery->updated_at)).'<br/>'.date('h:i A',strtotime($sQuery->updated_at)).'</td>                        
                                        </tr>';
            }
        }else{
            $html['inbox_msg'] = '<tr>
                                    <td colspan=4 class="text-danger"><center><i class="fa fa-times"></i> No message sent</center></td>                        
                                </tr>';
        }
        echo json_encode($html);
    }

    public function load_all_message_fx(Request $request){
        $selectQuery = TutorMessageModel::where(['receiver_id' => Auth::guard('teacher')->user()->id])
                                            ->orWhere(['sender_id' => Auth::guard('teacher')->user()->id])
                                            ->orderBy('updated_at','DESC')
                                            ->get();
        
        if(count($selectQuery) > 0){
            $html['inbox_msg'] = "";
            foreach($selectQuery as $sQuery){
                
                if(strlen($sQuery->message_details) > 80){
                    $message_details = substr(ucwords($sQuery->message_details),0,80)."...";
                }else{
                    $message_details = ucwords($sQuery->message_details);
                }
                if($sQuery->message_tbls_status == "active"){
                    $message_status_class = "active-class";
                }else if($sQuery->message_tbls_status == "inactive"){
                    $message_status_class = "inactive-class";
                }

                if($sQuery->sender_type == "teacher"){
                    if($sQuery->receiver_id == 0 ){
                        $user_name = "Admin";
                    }else if($sQuery->receiver_id != 0 ){
                        $getUserQuery = DB::table('users')
                                        ->where('id',$sQuery->receiver_id)
                                        ->get();
                        foreach($getUserQuery as $getUserQ){
                            $user_name = ucwords($getUserQ->first_name).' '.ucwords($getUserQ->last_name);
                        }
                    }
                }else if($sQuery->sender_type == "user"){
                    $getUserQuery = DB::table('tutors_personal_details')
                                    ->where('id',$sQuery->receiver_id)
                                    ->get();
                    foreach($getUserQuery as $getUserQ){
                        $user_name = ucwords($getUserQ->first_name).' '.ucwords($getUserQ->last_name);
                    }
                }else if($sQuery->sender_type == "admin"){
                    $getUserQuery = DB::table('tutors_personal_details')
                                    ->where('id',$sQuery->receiver_id)
                                    ->get();
                    foreach($getUserQuery as $getUserQ){
                        $user_name = ucwords($getUserQ->first_name).' '.ucwords($getUserQ->last_name);
                    }
                }
                $html['inbox_msg'] .= '<tr class="'.$message_status_class.'" >
                                            <td class="txt">'.strtoupper($sQuery->course_name).'<br/><sub> ('.ucwords($sQuery->topic_name).' )</sub></td>
                                            <td class="txt">'.$user_name.'</td>
                                            <td class="txt"><p>'.$message_details.'</p>
                                            </td>
                                            <td class="tm">'.date('Y-m-d',strtotime($sQuery->updated_at)).'<br/>'.date('h:i A',strtotime($sQuery->updated_at)).'</td> 
                                            <td><a href="javascript:;" onclick=send_message_student_to_teacher('.$sQuery->id.')><i class="fa fa-eye"></i></a></td>                         
                                        </tr>';
            }
        }else{
            $html['inbox_msg'] = '<tr>
                                    <td colspan=5 class="text-danger"><center><i class="fa fa-times"></i> No messages </center></td>                        
                                </tr>';
        }
        echo json_encode($html);
    }

    public function get_all_teacher_student_sub_msg_panel_data_fx(){
        $html['msg_panel'] = '';
        $get_tutor_msg_tbl_id = $_GET['id'];

        $getQuery = DB::table('tutor_message_tbls')->where('id',$_GET['id'])->get();
        $html = '';
        $getSubMsgQuery = DB::table('studenttutormsgrelationtbls')->where('message_tbls',$_GET['id'])->orderBy('updated_at','DESC')->get();
        if(count($getSubMsgQuery) > 0){
            foreach($getSubMsgQuery as $getSubMsgQ){
                if($getSubMsgQ->user_type_name == "user"){
                    $teacherQuery = DB::table('users')->where('id',$getSubMsgQ->user_ids)->get();
                    foreach($teacherQuery as $teacherQ){
                        $uname = ucwords($teacherQ->first_name)." ".ucwords($teacherQ->last_name);
                    }
                }else if($getSubMsgQ->user_type_name == "teacher"){
                    $teacherQuery = DB::table('tutors_personal_details')->where('id',$getSubMsgQ->user_ids)->get();
                    foreach($teacherQuery as $teacherQ){
                        $uname = ucwords($teacherQ->first_name)." ".ucwords($teacherQ->last_name);
                    }
                }
                $html .= '<tr>
                            <td>'.$uname.'</td>
                            <td>'.$getSubMsgQ->messages.'</td>
                          </tr>';
            }
        }
        if(count($getQuery) > 0){
            foreach($getQuery as $gQuery){
                $sender_type = $gQuery->sender_type;
                if($sender_type == "teacher"){
                    $teacherQuery = DB::table('tutors_personal_details')->where('id',$gQuery->sender_id)->get();
                    foreach($teacherQuery as $teacherQ){
                        $uname = ucwords($teacherQ->first_name)." ".ucwords($teacherQ->last_name);
                    }
                }else if($sender_type == "user"){
                    $teacherQuery = DB::table('users')->where('id',$gQuery->sender_id)->get();
                    foreach($teacherQuery as $teacherQ){
                        $uname = ucwords($teacherQ->first_name)." ".ucwords($teacherQ->last_name);
                    }
                }
                $html .= '<tr>
                            <td>'.$uname.'</td>
                            <td>'.$gQuery->message_details.'</td>
                          </tr>';
            }
        }
        echo json_encode($html);
    }

    public function send_message_teacher_submit_fx(Request $request){
        $insertArr = [
            'message_tbls' => $_GET['tutor_msg_id'], 
            'messages' => $_GET['tutor_student_msg'], 
            'user_ids' => Auth::user()->id, 
            'msg_view_type' => 'unseen', 
            'user_type_name' => 'user', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insertQuery = DB::table('studenttutormsgrelationtbls')->insert($insertArr);
        if($insertQuery){
            $msg = "success";
        }else{
            $msg = "error";
        }
        echo json_encode($msg);
    }

    public function send_message_teacher_student_submit_fx(Request $request){
        $insertArr = [
            'message_tbls' => $_GET['tutor_msg_id'], 
            'messages' => $_GET['tutor_student_msg'], 
            'user_ids' => Auth::guard('teacher')->user()->id, 
            'msg_view_type' => 'unseen', 
            'user_type_name' => 'teacher', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insertQuery = DB::table('studenttutormsgrelationtbls')->insert($insertArr);
        if($insertQuery){
            $msg = "success";
        }else{
            $msg = "error";
        }
        echo json_encode($msg);
    }

}