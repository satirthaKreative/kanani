<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Backend\CountryModel;
use App\Model\Backend\LanguageModel;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.pages.dashboard');
    }

    public function count_country_fx()
    {
        $countQuery = CountryModel::count();
        if($countQuery < 10){
            $countQuery = "0".$countQuery;
        }
        echo json_encode($countQuery);
    }

    public function count_language_fx()
    {
        $countQuery = LanguageModel::count();
        if($countQuery < 10){
            $countQuery = "0".$countQuery;
        }
        echo json_encode($countQuery);
    }
}