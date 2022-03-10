<?php

namespace App\Http\Controllers\Admin\Tutors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Tutors\AssignTutorModel;
use App\Model\Backend\TutorModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTutorMail;
use App\User;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $checkQuery = TutorModel::orderBy('id','DESC')->get();
        return view('admin.dashboard.pages.tutor',compact('checkQuery'));
    }  

    public function add_tutor_fx(Request $request)
    {
        $checkQuery = TutorModel::where(["email" => strtolower($request->input('modal_email_name'))])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This email address already added');
            return redirect()->back();
        }
        else
        {
            if($request->hasFile('modal_file_name'))
            {
                $tutor_img = $request->file('modal_file_name')->store('public/tutor');
            }
            else
            {
                $tutor_img = "";
            }
            $insertArr = [
                "first_name" => strtolower($request->input('modal_first_name')), 
                "last_name" => strtolower($request->input('modal_last_name')),
                "email" => strtolower($request->input('modal_email_name')),
                "password" => Hash::make($request->input('modal_password_name')),
                "img_file" => $tutor_img,
                "tutor_state" => 'active',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = TutorModel::insert($insertArr);
            if($insertQuery){
                $details=[
                    "email"=>strtolower($request->input('modal_email_name')),
                    "title"=>"Kanani Education Tutor Credentials",
                    "body"=>"<b>Your Tutor Email: </b>".strtolower($request->input('modal_email_name'))."<br /><b>Your Tutor Password: </b>secret00"
                ];
                Mail::to(strtolower($request->input('modal_email_name')))->send(new SendTutorMail($details));
                $request->session()->flash('success_msg', 'Successfully added');
                return redirect()->back();
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
                return redirect()->back();
            }
        }
        
    }


    public function edit_tutor_fx(Request $request)
    {
        $selectQuery = TutorModel::where(['id' => $_GET['id'] ])->get();
        foreach($selectQuery as $sQuery)
        {
            $html['first_name'] = $sQuery->first_name;
            $html['last_name'] = $sQuery->last_name;
            $html['email'] = $sQuery->email;
            if($sQuery->img_file != null || $sQuery->img_file != "")
            {
                $html['img_file'] = '<img src="'.asset(str_replace('public','storage/app/public',$sQuery->img_file)).'" alt="no image" width="100px" />';
            }
            else
            {
                $html['img_file'] = '';
            }
        }
        echo json_encode($html);
    }

    public function update_tutor_fx(Request $request)
    {
        $checkQuery = TutorModel::where(["email" => strtolower($request->input('modal_email_name'))])->where('id','!=',$request->input('edit_tutor_hidden_id_name'))->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This email already added to another account');
            return redirect()->back();
        }
        else
        {
            if($request->hasFile('modal_file_name'))
            {
                $tutor_img = $request->file('modal_file_name')->store('public/tutor');
                $insertArr = [
                    "first_name" => strtolower($request->input('modal_first_name')), 
                    "last_name" => strtolower($request->input('modal_last_name')),
                    "email" => strtolower($request->input('modal_email_name')),
                    "password" => Hash::make($request->input('modal_password_name')),
                    "img_file" => $tutor_img,
                    "tutor_state" => 'active',
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];
            }
            else
            {
                $insertArr = [
                    "first_name" => strtolower($request->input('modal_first_name')), 
                    "last_name" => strtolower($request->input('modal_last_name')),
                    "email" => strtolower($request->input('modal_email_name')),
                    "password" => Hash::make($request->input('modal_password_name')),
                    "tutor_state" => 'active',
                    "updated_at" => date('Y-m-d H:i:s') 
                ];
            }
            
    
            $insertQuery = TutorModel::where('id',$request->input('edit_tutor_hidden_id_name'))->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
                return redirect()->back();
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
                return redirect()->back();
            }
        }
    }

    public function del_tutor_fx(Request $request)
    {
        $delQuery = TutorModel::where(['id' => $_GET['id'] ])->delete();
        $msg = "error";
        if($delQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }

    public function change_status_tutor_fx(Request $request)
    {
        $updateStateArr = [
            "tutor_state" => $_GET['new_state'],
        ];
        $updateStateQuery = TutorModel::where(['id' => $_GET['id'] ])->update($updateStateArr);
        $msg = "error";
        if($updateStateQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }

    # tutor assign
    public function assign_teacher_show_fx(Request $request){
        // $assignTutorsQuery = DB::table('assign_tutors_tbls')
        //                     ->select('assign_tutors_tbls.id','tutors_personal_details.first_name as teacherFirstName','tutors_personal_details.last_name as teacherSecondName')
        //                     ->join('tutors_personal_details','assign_tutors_tbls.teacher_id','=','tutors_personal_details.id')
        //                     ->join('users','assign_tutors_tbls.student_id','=','users.id')
        //                     ->get();
        return view('admin.dashboard.pages.tutors.tutors');
    }

    public function load_assign_tutor_on_course_fx(Request $request){
        $mainQuery = DB::table('monthly_pay_tbls')
                    ->select('users.first_name','users.last_name','course_tbls.topic_name','course_tbls.course_name','users.id as user_id','course_tbls.id as course_id')
                    ->join('student_booking_tbls','monthly_pay_tbls.booking_id','=','student_booking_tbls.id')
                    ->join('course_tbls','course_tbls.id','=','monthly_pay_tbls.course_tbl_id')
                    ->join('course_package_tbls','course_package_tbls.id','=','student_booking_tbls.paypal_package_name')
                    ->join('users','users.id','=','student_booking_tbls.user_id')
                    ->get();
        $html = "";
        foreach($mainQuery as $mQuery){
            $teacherAssignedQuery = DB::table('assign_tutors_tbls')->where(['student_id' => $mQuery->user_id, 'course_id' => $mQuery->course_id])->get();
            if(count($teacherAssignedQuery) > 0){
                foreach($teacherAssignedQuery as $teacherAssign){
                    $teacher_id = $teacherAssign->teacher_id;
                    $teacherQuery = DB::table('tutors_personal_details')->where('id',$teacher_id)->get();
                    foreach($teacherQuery as $teacherQ){
                        $assign_teacher = $teacherQ->first_name." ".$teacherQ->last_name;
                    }
                }
            }else{
                $assign_teacher = 'did not assigned yet';
            }
            
            $html .= '<tr>
                        <td>'.ucwords($mQuery->topic_name).' ( '.ucwords($mQuery->course_name).' )</td>
                        <td>'.ucwords($mQuery->first_name).' '.ucwords($mQuery->last_name).'</td>
                        <td>'.$assign_teacher.'</td>
                        <td>Active</td>
                        <td class="text-white"><a class="btn btn-info btn-sm" href="javascript:;" onclick="assign_a_teacher('.$mQuery->user_id.' , '.$mQuery->course_id.')">Assign a Teacher</a></td>
                    </tr>';
        }
        echo json_encode($html);
    }

    public function course_assign_tutor_fx(Request $request){
        $teacherQuery = DB::table('tutors_personal_details')->get();
        $html = "<option>Choose a tutor</option>";
        foreach($teacherQuery as $tutorQ){
            $html .= "<option value=".$tutorQ->id.">".$tutorQ->first_name." ".$tutorQ->last_name."</option>";
        }
        echo json_encode($html);
    }

    public function assign_tutor_final_submit_fx(Request $request){
        $insertArr = [
            'teacher_id' => $request->input('choose_course_with_tutors'), 
            'student_id' => $request->input('student_name'), 
            'course_id' => $request->input('course_name'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ];
        $insertQuery = DB::table('assign_tutors_tbls')->insert($insertArr);
        return redirect()->back();
    }
    
}