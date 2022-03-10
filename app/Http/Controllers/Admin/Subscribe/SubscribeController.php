<?php

namespace App\Http\Controllers\Admin\Subscribe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Suscribe\SubcribeModel;

class SubscribeController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        # get subscribers
        $getSubscriberQuery = SubcribeModel::get();
        return view('admin.dashboard.pages.subscribe.subscribe',compact('getSubscriberQuery'));
    }
}
