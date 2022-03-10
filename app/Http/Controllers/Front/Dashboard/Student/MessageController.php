<?php

namespace App\Http\Controllers\Front\Dashboard\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CourseModel;
use App\Model\Backend\CourseAgeModel;
use App\Model\Backend\LearningTypeModel;
use App\Model\Backend\AdminFreeTrailModel;
use App\Model\Backend\Config\FreeTrailConfigModel;
use App\Model\Frontend\FreeTrailBookingModel;
use App\Model\Backend\FreetrailConfigNewModel;
use App\Model\Frontend\Message\MessageModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreeTrailEmail;
use App\Model\Frontend\Message\Student\StudentAdminMsgModel;
use App\Model\Frontend\Message\Tutor\TutorMessageModel;

class MessageController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function message_page_fx(Request $request){
        $courseQuery = CourseAgeModel::get();
        $learningTypeQuery = LearningTypeModel::where('learning_status','active')->get();
        return view('front.pages.dashboard-student.pages.message.message',compact('courseQuery','learningTypeQuery'));
    }

    public function message_calender_page_fx(Request $request){
        $calenderQuery = AdminFreeTrailModel::where('teachers_avail','active')->get();
        $calenderArr = array();
        foreach($calenderQuery as $calenderQ)
        {
            $calenderArr[] = $calenderQ->teachers_date;
        }

        $todayDate = date("Y-m-d");
        $outCalenderArr = array();
        $outCalenderArr[] = $todayDate;
        for($i = 1; $i < 30; $i++)
        {
            $checkdates = date('Y-m-d',strtotime($todayDate."+ ".$i." days"));
            if(!in_array($checkdates , $calenderArr))
            {
                $outCalenderArr[] = date('Y-m-d',strtotime($todayDate."+ ".$i." days"));
            }
        }

        echo json_encode($outCalenderArr);
    }

    public function message_calender_time_page_fx(Request $request)
    {
        // config interval
        $checkIntervalQuery =  FreeTrailConfigModel::where('id',1)->get();
        if(count($checkIntervalQuery) > 0)
        {
            foreach ($checkIntervalQuery as $key_value) {
                $hrs_time = $key_value->config_time_hrs_interval;
                $mins_time = $key_value->config_time_mins_interval;

                $total_count_in_mins = (($hrs_time*60)+$mins_time);
            }
        }

        $html['interval_time_of_date'] = $total_count_in_mins;

        $checkQuery = AdminFreeTrailModel::where('teachers_date',date('Y-m-d',strtotime($_GET['avail_checked_date'])))->get();
        if(count($checkQuery) > 0){
            foreach($checkQuery as $checkQ){
                $checking_time = $checkQ->avail_from_time;
                // diff times
                $start = strtotime($checkQ->avail_from_time);
                $end = strtotime($checkQ->avail_to_time);
                $mins = ($end - $start) / 60;
                // diff times
            }
        }

        $getChoosenDate = $_GET['avail_checked_date'];

        $divide_time = $mins/$total_count_in_mins;
        $whole_time = (int) $divide_time;

        $html['whole_main_time'] = '<option value="">Choose time</option>';
        $addingMinutes= date('H:i',strtotime("+ ".$hrs_time." hour + ".$mins_time." minute",strtotime($checking_time)));
        $disabled_var = '';
        if($this->choose_time_checking_fx($addingMinutes, $getChoosenDate))
        {
            $disabled_var = 'disabled';
        }
        $html['whole_main_time'] .= '<option value="'.$addingMinutes.'" '.$disabled_var.'>'.date('H:i',strtotime($checking_time)).' -- '.$addingMinutes."</option>";
        for($i=0; $i < $whole_time; $i++)
        {
            $addingMinutesOld = $addingMinutes;
            $addingMinutes = date('H:i',strtotime("+ ".$hrs_time." hour + ".$mins_time." minute",strtotime($addingMinutes)));
            $disabled_var = '';
            if($this->choose_time_checking_fx($addingMinutes, $getChoosenDate))
            {
                $disabled_var = 'disabled';
            }
            if(strtotime($addingMinutes) > $end)
            {
                break;
            }
            $html['whole_main_time'] .= '<option value="'.$addingMinutes.'" '.$disabled_var.'>'.$addingMinutesOld.' -- '.$addingMinutes."</option>";
        }

        echo json_encode($html);
    }

    public function choose_time_checking_fx($addingMinutes, $getChoosenDate)
    {
        $checkedDate = date('Y-m-d',strtotime($getChoosenDate));
        $checkedTime = date('H:i:s',strtotime($addingMinutes));
        $checkingQuery = FreeTrailBookingModel::where(['avail_date_booking' => $checkedDate, 'available_time' => $checkedTime])->get();
        if(count($checkingQuery) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function message_free_trail_class_booking_submit_fx(Request $request)
    {
        $age_name = $request->input('age_scale_name');
        $english_level = $request->input('english_learn_scale_name');
        $available_date = date('Y-m-d H:i:s',strtotime($request->input('avail_date_name')));
        $time_slot = $request->input('avail_date_time_name');
        $time_intervel = $request->input('hidden_interval_time_name');
        $message = $request->input('leave_msg_name');

        $insertArr = [
            'user_id' => Auth::user()->id,
            'age_id' => $age_name,
            'english_level_id' => $english_level,
            'avail_date_booking' =>date('Y-m-d H:i:s',strtotime($request->input('avail_date_name'))),
            'available_time' => $time_slot,
            'avail_time_interval' => $time_intervel,
            'timezone_tbl_id' => $request->input('timezone_name'),
            'msg_data' => $message,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $insertQuery = FreeTrailBookingModel::insert($insertArr);
        if($insertQuery){
                $getChildQuery = User::where('id',Auth::user()->id)->get();
                foreach($getChildQuery as $gChild){
                    $getChildId = $gChild->id;
                    $getChildEmail = $gChild->email;
                    $getChildName = $gChild->first_name." ".$gChild->last_name;
                }
                // timezone
                $getTimezoneQuery = DB::table('calendar_timezone_tbl')->where('id',$request->input('timezone_name'))->get();
                foreach($getTimezoneQuery as $timeZoneQ){
                    $time_zone_name = $timeZoneQ->TimeZone;
                    $utc_offset = $timeZoneQ->UTCoffset;
                }
                // end timezone
                $details=[
                    "reply_to_main_email" => $getChildEmail,
                    "email"=>'satirtha.kreative@gmail.com',
                    "subject" => "Hello",
                    "title"=>"Free Trail Booking Slot",
                    "body"=>"<b>Client Name: </b>".$getChildName."<br /><b>Booking Date: </b>".date('d M,Y',strtotime($request->input('avail_date_name')))."<br /><b>Booking Timing: </b>".date('H:i',strtotime(" - ".$time_intervel." minute",strtotime($time_slot)))." to ".$time_slot." ( ".$time_zone_name."  ".$utc_offset." )<br /><b>Query: </b>".$message,
                ];
                Mail::to('satirtha.kreative@gmail.com')->bcc($getChildEmail)->send(new FreeTrailEmail($details));
                $updateCQuery = FreetrailConfigNewModel::insert(['user_id' => Auth::user()->id]);
            $request->session()->flash('success_msg', 'Your trail slot successfully booked');
        }else{
            $request->session()->flash('error_msg', 'Something went wrong! try again  later ');
        }
        return redirect()->back();
    }

    # checking subject -- message
    public function message_trail_student_subject_choose_fx(Request $request)
    {
        $getSubjectsQuery = CourseModel::where('user_role',Auth::user()->user_role)->get();
        if(count($getSubjectsQuery) > 0){
            $html['subject_html'] = '<option value="">Choose subjects</option>';
            foreach($getSubjectsQuery as $getSubjectQ)
            {
                $html['subject_html'] .= '<option value="'.$getSubjectQ->id.'">'.ucwords($getSubjectQ->topic_name).'('.ucwords($getSubjectQ->course_name).')'.'</option>';
            }
        }else{
            $html['subject_html'] = '<option value="" disabled selected>No Subject Choosen Yet</option>';
        }
        echo json_encode($html);
    }

    # checking for total messages
    public function checking_total_messages_fx(Request $request)
    {
        $totalMessageQuery = MessageModel::where(['sender_id' => Auth::user()->id])->orWhere(['receiver_id' => Auth::user()->id])->orderBy('updated_at','DESC')->get();
        $html['msg_html'] = '<tr>
                                <th>No</th>
                                <th>Subject</th>
                                <th>Total messages</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>';
        $count = 1;
        foreach($totalMessageQuery as $totalQ){
            $count_panel = $count;
            if($count < 10) {
                $count_panel = "0".$count;
            }

            $msg = ucwords($totalQ->message_details);
            if(strlen($msg) > 50){
                $msg = substr(ucwords($totalQ->message_details),0,50)."...";
            }

            $html['msg_html'] .=   '<tr>
                                        <td>#'.$count_panel.'</td>
                                        <td>'.ucwords($totalQ->topic_name).'</td>
                                        <td>'.$msg.'</td>
                                        <td>'.date('M d,y',strtotime($totalQ->updated_at)).'</td>
                                        <td class="text-info"><a href="javascript:;" onclick=total_count_panel_fx('.$totalQ->id.')><i class="fa fa-eye"></i></a></td>
                                    </tr>';
            $count++;
        }
        echo json_encode($html);
    }

    # message submit
    public function message_submit_fx(Request $request)
    {
        $userType_name = $request->input('message_to_usertype_name');
        if($userType_name == "admin"){
            $user_type = "admin";
            $teacher_receiver_type = 0;
        }
        $subject_name_id = $request->input('subject_name');
        $message_name = $request->input('subject_message_name');

        $getCourseTablesQuery = CourseModel::where('id',$subject_name_id)->get();
        foreach($getCourseTablesQuery as $getCourseQ){
            $getMainCourseId = $getCourseQ->main_course_id;
            $courseName = $getCourseQ->course_name;
            $topicName = $getCourseQ->topic_name;
        }

        if($subject_name_id == "" || $subject_name_id == null){
            $request->session()->flash('error_msg','Please enter subject name');
        }else if($message_name == "" || $message_name == null){
            $request->session()->flash('error_msg','Please enter subject name');
        }else{
            $insertArr = [
                "course_tbls_id" => $subject_name_id,
                "course_name" => $courseName,
                "topic_name" => $topicName,
                "user_type" => $user_type,
                "teacher_id" => $teacher_receiver_type,
                "sender_id" => Auth::user()->id,
                "receiver_id" => 0,
                "sender_type" => 'user',
                "message_details" => $message_name,
                "message_tbls_status" => 'inactive',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $insertQuery = MessageModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully added');
            }else{
                $request->session()->flash('error_msg','Try again! Something went wrong');
            }
        }
        return redirect()->back();
    }

    # message -- student -- admin
    public function studentAdminSection_fx(Request $request){
        $messageQuery = DB::table('message_tbls')
                        ->select('message_tbls.id','message_tbls.course_name','message_tbls.topic_name','message_tbls.user_type','message_tbls.sender_type','message_tbls.sender_id','message_tbls.receiver_id','message_tbls.message_details','message_tbls.message_tbls_status','users.first_name','users.last_name')
                        ->join('course_tbls','course_tbls.id','=','message_tbls.course_tbls_id')
                        ->join('users','users.id','=','message_tbls.sender_id')
                        ->where('message_tbls.id',$_GET['id'])
                        ->get();
        $subMessageQuery = StudentAdminMsgModel::where('message_tbls',$_GET['id'])->orderBy('id','DESC')->get();
        $html['student_admin_html'] = "";
        foreach($subMessageQuery as $subMsgCk){
            $sub_msg_details = $subMsgCk->messages; $user_check = $subMsgCk->user_ids;
            if($user_check == 0){ $user_type = "Admin";}
            else{ foreach($messageQuery as $msgCk) { $user_type = $msgCk->first_name." ".$msgCk->last_name; } }
            $html['student_admin_html'] .= "<tr><td>".ucwords($user_type)."</td><td>".$sub_msg_details."</td></tr>";
        }
        foreach($messageQuery as $msgCk){
            $html['student_admin_primary_id'] = $msgCk->id;
            $msg_details = $msgCk->message_details;
            $html['student_admin_html'] .= '<tr><td>'.$msgCk->first_name.' '.$msgCk->last_name.'</td><td>'.$msg_details.'</td></tr>';
        }

        echo json_encode($html);
    }

    public function student_admin_msg_submitting_fx(Request $request){
        $user_id = Auth::user()->id;
        $msg_tbl_id = $_GET['msg_tbl_id'];
        $message_des = $_GET['message_des'];
        $insertArr = [
            "message_tbls" => $msg_tbl_id,
            "messages" => $message_des,
            "user_ids" => $user_id,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $insertQuery = StudentAdminMsgModel::insert($insertArr);
        if($insertQuery){
            $msg = "success";
        }else{
            $msg = "error";
        }
        echo json_encode($msg);
    }

    public function student_to_teacher_contact_course_fx(Request $request){
        $tutorQuery = DB::table('assign_tutors_tbls')->where('student_id',Auth::user()->id)->get();
        $html_assign_tutor = '<option value="">Choose a teacher name & course name </option>';
        foreach($tutorQuery as $tutorQ){
            $student_id = $tutorQ->student_id;
            $course_id = $tutorQ->course_id;
            $teacher_id = $tutorQ->teacher_id;
            # course name
            $getCourseQuery = DB::table('course_tbls')->where('id',$course_id)->get();
            foreach($getCourseQuery as $getCourseQ){
                $course_name = " ( ".ucwords($getCourseQ->topic_name)." : ".ucwords($getCourseQ->course_name)." )";
            }
            # teacher name
            $getTutorQuery = DB::table('tutors_personal_details')->where('id',$teacher_id)->get();
            foreach($getTutorQuery as $getTutorQ){
                $tutor_name = ucwords($getTutorQ->first_name)." ".ucwords($getTutorQ->last_name);
            }
            $html_assign_tutor .= '<option value='.$tutorQ->id.'>'.$tutor_name.$course_name.'</option>';
        }
        echo json_encode($html_assign_tutor);
    }

    public function student_to_teacher_message_submit_fx(Request $request){
        $assign_tutor_tbl_id = $request->input('subject_name');
        $message_details = $request->input('subject_message_name');

        $tutorQuery = DB::table('assign_tutors_tbls')->where('id',$assign_tutor_tbl_id)->get();
        foreach($tutorQuery as $tutorQ){
            $student_id = $tutorQ->student_id;
            $course_id = $tutorQ->course_id;
            $teacher_id = $tutorQ->teacher_id;
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
            'teacher_id' => $teacher_id,
            'sender_id' => $student_id,
            'receiver_id' => $teacher_id,
            'sender_type' => 'user',
            'message_details' => $message_details,
            'message_tbls_status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insertQuery = TutorMessageModel::insert($insertArr);
        if($insertQuery){
            $request->session()->flash('success_msg','Successfully student message');
        }else{
            $request->session()->flash('error_msg','Something went wrong! Try again later');
        }
        return redirect()->back();
    }

    public function laod_teacher_all_message_fx(Request $request){
        $selectQuery = TutorMessageModel::where(['receiver_id' => Auth::user()->id])
                        ->orWhere(['sender_id' => Auth::user()->id])
                        ->orderBy('updated_at','DESC')
                        ->get();

        if(count($selectQuery) > 0){
            $html['inbox_msg'] = '<tr>
                                    <th>Subject</th>
                                    <th>Total messages</th>
                                    <th>Date</th>
                                    <th>View</th>
                                  </tr>';
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
                                            <td class="txt"><p>'.$message_details.'</p>
                                            </td>
                                            <td class="tm">'.date('Y-m-d',strtotime($sQuery->updated_at)).'<br/>'.date('h:i A',strtotime($sQuery->updated_at)).'</td>
                                            <td><a href="javascript:;" onclick=send_message_student_to_teacher('.$sQuery->id.')><i class="fa fa-eye"></i></a></td>
                                        </tr>';
            }
        }else{
            $html['inbox_msg'] = '<tr>
                                    <td colspan=4 class="text-danger"><center><i class="fa fa-times"></i> No messages </center></td>
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
}
