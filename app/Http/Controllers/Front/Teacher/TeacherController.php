<?php

namespace App\Http\Controllers\Front\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CountryModel;
use App\Model\Backend\TutorModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Event;
use Calendar;
use App\User;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:teacher');
    }
    # calender page
    public function calender_fx(Request $request){
        $checkingEvent = Event::where('teacher_id',Auth::guard('teacher')->user()->id)->get();
        $events = Event::where('teacher_id',Auth::guard('teacher')->user()->id)->get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
            $title = "(".date('h:i a',strtotime($event->start_time))." - ".date('h:i a',strtotime($event->end_time)).")";
            $event_list[] = Calendar::event(
                    $title,
                    true,
                    new \DateTime($event->available_date),
                    new \DateTime($event->available_date),
                    [
                        'color' => '#1a4568',
                    ]
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
        return view('front.pages.dashboard-teacher.calender', compact('calendar_details') );
    }

    public function addEvent(Request $request)
    {
        $available_new_fetch_date = date('Y-m-d',strtotime($request['available_date_name']));
        $checkingQuery = Event::where(['available_date' => $available_new_fetch_date ])
                        ->where('start_time','<=',date('H:i:s',strtotime($request['start_time_name'])) )
                        ->where('end_time','>',date('H:i:s',strtotime($request['start_time_name'])) )
                        ->where('teacher_id',Auth::guard('teacher')->user()->id)
                        ->get();
        
        if(count($checkingQuery) > 0){
            \Session::flash('warnning','This timeframe already added');
            return Redirect::to('/teacher/calender');
        }else{
            $validator = Validator::make($request->all(), [
                'event_name' => 'required',
                'available_date_name' => 'required',
                'start_time_name' => 'required',
                'end_time_name' => 'required',
            ]);
    
            if ($validator->fails()) {
                \Session::flash('warnning','Please enter the valid details');
                return Redirect::to('/teacher/calender')->withInput()->withErrors($validator);
            }
    
            $event = new Event;
            $event->event_name = $request['event_name'];
            $event->available_date = $request['available_date_name'];
            $event->start_time = $request['start_time_name'];
            $event->end_time = $request['end_time_name'];
            $event->teacher_id = Auth::guard('teacher')->user()->id;
            $event->updated_action = 'notUpdated';
            $event->save();
    
            \Session::flash('success','Event added successfully.');
            return Redirect::to('/teacher/calender');
        }
    }

    # message page
    public function teacher_message_fx(Request $request){
        return view('front.pages.dashboard-teacher.message');
    }

    # class schedule
    public function teacher_class_schedule_fx(Request $request){
        return view('front.pages.dashboard-teacher.class-schedule');
    }

    # schedule
    public function teacher_schedule_fx(Request $request){
        return view('front.pages.dashboard-teacher.schedule');
    }

    # show full schedule
    public function load_schedule_data_fx(Request $request){
        $scheduleQuery = DB::table('assign_tutors_tbls')->where(['teacher_id' => Auth::guard('teacher')->user()->id])->get();
        $html = '<tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Course</th>   
                    <th>Level</th>
                    <th>Unit</th>  
                    <th>Lesson</th>  
                    <th>Student Name</th>                    
                </tr>';
        if(count($scheduleQuery) > 0){
            $i = 0;
            foreach($scheduleQuery as $scheduleQ){
                $studentQuery = DB::table('users')->where(['id' => $scheduleQ->student_id])->get();
                foreach($studentQuery as $studentQ){
                    $student_name = $studentQ->first_name." ".$studentQ->last_name;
                }
                # course 
                $courseQuery = DB::table('course_tbls')->where(['id' => $scheduleQ->course_id])->get();
                foreach($courseQuery as $courseQ){
                    $course_name = ucwords($courseQ->course_name);
                    $topic_name = ucwords($courseQ->topic_name);
                    $no_of_units = $courseQ->no_of_units;
                    $no_of_lessons = $courseQ->no_of_lessons;
                }
                $html .= '<tr>
                            <td>'.++$i.'</td>
                            <td>'.date('M d,Y',strtotime($scheduleQ->created_at)).'</td>
                            <td>Not defined</td>  
                            <td><strong> '.$course_name.'</strong></td>
                            <td>'.$topic_name.'</td>
                            <td>'.$no_of_units.'</td>
                            <td>'.$no_of_lessons.'</td> 
                            <td>'.$student_name.'</td>    
                        </tr>';
            }
        }else{
            $html .= '<tr><td colspan=8><center class="text-danger"><i class="fa fa-times"></i> No classes added yet</center></td></tr>';
        }

        echo json_encode($html);
    }

    # my account
    public function teacher_my_account_fx(Request $request){
        $countryQuery = CountryModel::where('country_state','active')->get();
        $tutorQuery = TutorModel::where('id',Auth::guard('teacher')->user()->id)->get();
        return view('front.pages.dashboard-teacher.my-account',compact('countryQuery','tutorQuery'));
    }

    # my account submit
    public function teacher_my_account_details_submit_fx(Request $request){
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $country_name = $request->input('country_name');
        $email_name = $request->input('email_name');
        $phone_name = $request->input('phone_name');

        if($first_name == "" || $first_name == null){
            $request->session()->flash('error_msg','Please enter your first name');
        }else if($last_name == "" || $last_name == null){
            $request->session()->flash('error_msg','Please enter your last name');
        }else if($country_name == "" || $country_name == null){
            $request->session()->flash('error_msg','Please enter your country name');
        }else if($email_name == "" || $email_name == null){
            $request->session()->flash('error_msg','Please enter your email name');
        }else if($phone_name == "" || $phone_name == null){
            $request->session()->flash('error_msg','Please enter your phone number');
        }else{
            $updateArr = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email_name,
                'country_id' => $country_name,
                'phone_num' => $phone_name
            ];
            $updateQuery = TutorModel::where('id',Auth::guard('teacher')->user()->id)->update($updateArr);
            if($updateQuery){
                $request->session()->flash('success_msg','Successfully updated the teacher profile');
            }else{
                $request->session()->flash('error_msg','Try again! Something went wrong');
            }
        }
        return redirect()->back();
    }


    public function load_course_share_zoom_link_fx(Request $request){
        $zoomLinkQuery = DB::table('assign_tutors_tbls')->where('teacher_id',Auth::guard('teacher')->user()->id)->get();
        if(count($zoomLinkQuery) > 0){
            $html['zoom_link_details'] = '<option value="">Choose a course</option>'; 
            foreach($zoomLinkQuery as $zoomQuery){
                # get course details
                $courseQuery = DB::table('course_tbls')->where('id',$zoomQuery->course_id)->get();
                foreach($courseQuery as $courseData){
                    $course_id = $courseData->id;
                    $course_name = $courseData->course_name;
                    $topic_name = $courseData->topic_name;
                }
                $html['zoom_link_details'] .= '<option value='.$zoomQuery->id.'>'.ucwords($topic_name).' ( '.ucwords($course_name).' )</option>';
            }
        }else{
            $html['zoom_link_details'] = '<option value="">Choose a course</option>';
        }
        echo json_encode($html);
    }

    public function checking_load_course_for_zoom_link_fx(Request $request){
        # assign tutors
        $assignTutorQuery = DB::table('assign_tutors_tbls')->where('id',$_GET['course_id'])->get();
        foreach($assignTutorQuery as $assignQ){
            $tutor_id = $assignQ->teacher_id;
            $course_id = $assignQ->course_id;
            $student_id = $assignQ->student_id;
        }
        # zoom query
        $zoomQuery = DB::table('monthly_pay_tbls')
                        ->where(['user_id' => $student_id, 'course_tbl_id' => $course_id])
                        ->get();
        if(count($zoomQuery) > 0){
            # get booking id
            foreach($zoomQuery as $zoomQ){
                $bookingId = $zoomQ->booking_id;
            }
            # user details 
            $userQuery = User::where(['id' => $student_id])->get();
            foreach($userQuery as $uQuery){
                $username = ucwords($uQuery->first_name)." ".ucwords($uQuery->last_name);
            }
            # course details 
            $courseQuery = DB::table('course_tbls')
                                ->where('id',$course_id)
                                ->get();
            foreach($courseQuery as $courseQy){
                $course_name = $courseQy->course_name;
                $topic_name = $courseQy->topic_name;
            }

            $html['total_booking_html'] =   '<tr>
                                                <th>Student Name</th>
                                                <th>Course Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Zoom Link</th>
                                                <th>Send Link</th>                      
                                            </tr>';

            # get booking table details
            $bookingDetailsQuery = DB::table('student_booking_timeslot_tbls')
                                    ->where('student_booking_id',$bookingId)
                                    ->where('student_booking_date','>=',date('Y-m-d'))
                                    ->orderBy('student_booking_date','ASC')
                                    ->get();
            foreach($bookingDetailsQuery as $bookingQuery){
                $html['total_booking_html'] .= '<tr>
                                                    <td>'.$username.'</td>
                                                    <td>'.ucwords($topic_name).'<br /><sub>'.ucwords($course_name).'</sub></td>
                                                    <td>'.$bookingQuery->student_booking_date.'</td>
                                                    <td>'.$bookingQuery->course_class_start_time_name.'</td>  
                                                    <td>'.$bookingQuery->zoom_links.'</td>
                                                    <td>
                                                        <a href="javascript:;" class="btn btn-success btn-sm text-white" onclick=send_zoom_link('.$bookingQuery->id.',"student_booking_timeslot_tbls")>Send Link</a>
                                                    </td>                      
                                                </tr>';
            }
            # get booking additional details table
            $additionalBookingQuery = DB::table('next3_student_booking_tbls')
                                            ->where('student_booking_id',$bookingId)
                                            ->where('student_booking_date','>=',date('Y-m-d'))
                                            ->orderBy('student_booking_date','ASC')
                                            ->get();
            foreach($additionalBookingQuery as $additionalBookingQuery){
            $html['total_booking_html'] .= '<tr>
                                                <td>'.$username.'</td>
                                                <td>'.ucwords($topic_name).'<br /><sub>'.ucwords($course_name).'</sub></td>
                                                <td>'.date("M d,y",strtotime($additionalBookingQuery->student_booking_date)).'</td>
                                                <td>'.date("h:i a",strtotime($additionalBookingQuery->course_class_start_time_name)).'</td>  
                                                <td>'.$additionalBookingQuery->zoom_links.'</td>
                                                <td><a href="javascript:;" class="btn btn-success btn-sm text-white" onclick=send_zoom_link('.$additionalBookingQuery->id.',"next3_student_booking_tbls")>Send Link</a></td>                      
                                            </tr>';
            }
        }else{
            $html['total_booking_html'] =   '<tr>
                                                <th>Student Name</th>
                                                <th>Course Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Zoom Link</th>
                                                <th>Send Link</th>                      
                                            </tr>';

            $html['total_booking_html'] .=  '<tr>
                                                <td colspan=6>
                                                    <center class="text-danger"><i class="fa fa-times"></i> No classes</center>
                                                </td>
                                            </tr>';
        }
        echo json_encode($html);
    }

    public function send_zoom_link_fx(Request $request){
        $table_id_name = $request->input('table_name');
        $zoom_id_name = $request->input('zoom_id_name');
        $zoom_links_name = $request->input('zoom_links_name');

        $insertArr = [
            'zoom_links' => $zoom_links_name
        ];

        $updateQuery = DB::table($table_id_name)->where('id',$zoom_id_name)->update($insertArr);
        if($updateQuery){
            $request->session()->flash('success_msg','Successfully send the zoom link');
        }else{
            $request->session()->flash('error_msg','Successfully send the zoom link');
        }
        return redirect()->back();
    }
}