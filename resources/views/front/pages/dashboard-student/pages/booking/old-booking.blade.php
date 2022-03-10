@extends('front.app-student')
@section('content')
            <div class="my-account-page booking-page">

                <form action="">
                   <div class="row">
                       <div class="col-lg-8">
                           <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Course packages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">2 Days a week</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">3 Days a week</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">5 Days a week</a>
                            </li>
                        </ul><!-- Tab panes -->
                       </div>
                       <div class="col-lg-4">
                            <div class="coursetype">
                                <label for="">Course type</label>
                                <select name="" id="">
                                    <option value="">English conversation course</option>
                                </select>
                            </div>
                       </div>
                   </div>

                   <div class="row">
                    <div class="col-lg-8">
                        <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                             <table>
                                  <tr>
                                    <th>Time</th>
                                    <th>Packages</th>
                                    <th>Duration</th>
                                    <th>Lessons</th>  
                                    <th>Price</th> 
                                    <th></th>                     
                                  </tr>
                                  <tr>
                                    <td rowspan="3" style="border-right: 1px solid #dedede;">
                                        <div class="big-font">20 <span>min</span></div>
                                    </td>
                                    <td>ENG-3044</td>
                                    <td>1 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td><div class="custom-radio">
                                        <input class="custom-radio__control" id="r1" name="custom-radio" required type="radio" value="male">
                                        <label class="custom-radio__label" for="r1"></label>
                                    </div>
                                    </td>              
                                  </tr>
                                  <tr>                                    
                                    <td>ENG-3044</td>
                                    <td>3 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td>
                                        <div class="custom-radio">
                                            <input class="custom-radio__control" id="r2" name="custom-radio" type="radio" value="female">
                                            <label class="custom-radio__label" for="r2"></label>
                                        </div>
                                    </td>              
                                  </tr>
                                  <tr>                                    
                                    <td>ENG-3044</td>
                                    <td>6 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td>
                                        <div class="custom-radio">
                                            <input class="custom-radio__control" id="r3" name="custom-radio" type="radio" value="nonDiscolse">
                                            <label class="custom-radio__label" for="r3"></label>
                                        </div>
                                    </td>              
                                  </tr>
                                  <tr>
                                    <td rowspan="3" style="border-right: 1px solid #dedede;">
                                        <div class="big-font">30 <span>min</span></div>
                                    </td>
                                    <td>ENG-3044</td>
                                    <td>1 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td><div class="custom-radio">
                                        <input class="custom-radio__control" id="r4" name="custom-radio" required type="radio" value="male">
                                        <label class="custom-radio__label" for="r4"></label>
                                    </div>
                                    </td>              
                                  </tr>
                                  <tr>                                    
                                    <td>ENG-3044</td>
                                    <td>3 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td>
                                        <div class="custom-radio">
                                            <input class="custom-radio__control" id="r5" name="custom-radio" type="radio" value="female">
                                            <label class="custom-radio__label" for="r5"></label>
                                        </div>
                                    </td>              
                                  </tr>
                                  <tr>                                    
                                    <td>ENG-3044</td>
                                    <td>6 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td>
                                        <div class="custom-radio">
                                            <input class="custom-radio__control" id="r6" name="custom-radio" type="radio" value="nonDiscolse">
                                            <label class="custom-radio__label" for="r6"></label>
                                        </div>
                                    </td>              
                                  </tr>
                                  <tr>
                                    <td rowspan="3" style="border-right: 1px solid #dedede;">
                                        <div class="big-font">50 <span>min</span></div>
                                    </td>
                                    <td>ENG-3044</td>
                                    <td>1 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td><div class="custom-radio">
                                        <input class="custom-radio__control" id="r7" name="custom-radio" required type="radio" value="male">
                                        <label class="custom-radio__label" for="r7"></label>
                                    </div>
                                    </td>              
                                  </tr>
                                  <tr>                                    
                                    <td>ENG-3044</td>
                                    <td>3 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td>
                                        <div class="custom-radio">
                                            <input class="custom-radio__control" id="r8" name="custom-radio" type="radio" value="female">
                                            <label class="custom-radio__label" for="r8"></label>
                                        </div>
                                    </td>              
                                  </tr>
                                  <tr>                                    
                                    <td>ENG-3044</td>
                                    <td>6 Month</td>
                                    <td>8</td>   
                                    <td><a href="#">$450.00</a></td>      
                                    <td>
                                        <div class="custom-radio">
                                            <input class="custom-radio__control" id="r9" name="custom-radio" type="radio" value="nonDiscolse">
                                            <label class="custom-radio__label" for="r9"></label>
                                        </div>
                                    </td>              
                                  </tr>
                              </table>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            
                        </div>
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            
                        </div>
                       
                      </div>
                    </div>                        
                   </div>
                   <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Start date</label>
                                <input type="text" placeholder="Select course start date">
                            </div>
                            <div class="col-lg-6">
                                <label for="">Class time(Your local time)</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="" id="">
                                            <option value="">00</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="" id="">
                                            <option value="">00</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="">Comment</label>
                                <textarea name=""   placeholder="Your comment"></textarea> 
                                
                            </div>                            
                           
                            <div class="col-lg-4">
                                <a href="#" class="paypal"><img src="{{ asset('frontend/studentDashboard/images/paypal.png') }}" alt=""></a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#" class="cardbtn"><img src="{{ asset('frontend/studentDashboard/images/card.png') }}" alt="">Debit or Credit card</a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#" class="cancel_btn">Cancel</a>
                            </div>
                        </div>
                    </div>                        
                    </div>
                </form>


            </div>
@endsection
@section('jsContent')

@endsection