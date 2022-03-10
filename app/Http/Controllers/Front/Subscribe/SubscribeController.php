<?php

namespace App\Http\Controllers\Front\Subscribe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Suscribe\SubcribeModel;

class SubscribeController extends Controller
{
    public function index(Request $request){
        $subscribe_email = strtolower($request->input('mail_address'));
        $subscribeQuery = SubcribeModel::where(['suscribe_email' => $subscribe_email])->get();
        if(count($subscribeQuery) > 0){
            $request->session()->flash('error_msg','You already subscribed');
        }else{
            $insertArr = [
                'suscribe_email' => strtolower($request->input('mail_address')),
                'admin_action'  => 'yes',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $insertQuery = SubcribeModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully subscribed');
            }else{
                $request->session()->flash('error_msg','Something went wrong! Try again');
            }
        }
        return redirect()->back();
    }
}
