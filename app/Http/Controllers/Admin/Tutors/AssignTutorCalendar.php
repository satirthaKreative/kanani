<?php

namespace App\Http\Controllers\Admin\Tutors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Tutors\AssignCalendarModel;

class AssignTutorCalendar extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        return view('admin.dashboard.pages.tutors.assign-tutor-calendar');
    }
}
