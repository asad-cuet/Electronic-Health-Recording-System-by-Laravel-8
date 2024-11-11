<!DOCTYPE html>
<html lang="en">
      <head>
            <meta charset="utf-8" />
            <title>Patient Status</title>  
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Dashboard - SB Admin</title>
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
            <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
    
    
            <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
            <link href="{{asset('template/css/styles.css')}}" rel="stylesheet">
            <style>
                  .hover-red:hover {
                    color:red!important;
                  }
              </style> 
        </head>
<body>



@if(Auth::user())
<div class="sb-nav-fixed">


@include('layout.nav')
<div id="layoutSidenav">
            @include('layout.sidebar')
            <div id="layoutSidenav_content">
            <main>
                  <div class="container-fluid mt-3 px-4">
                  @if(session()->has('status'))
                        <div class="alert alert-success" role="alert">
                              {{session('status')}}   
                        </div>                
                  @endif
                  @if(session()->has('danger'))
                        <div class="alert alert-danger" role="alert">
                              {{session('danger')}}   
                        </div>                
                  @endif
@endif                  





{{-- Content Start       --}}






      {{-- information and history section start --}}
      
      <div class="row">
            <div class="col-sm">
            <ul class="list-group">
                  <li class="list-group-item" aria-current="true" style="background-color:#D69C2F">
                        Patient Basic Information
                  </li>
                  <li class="list-group-item"><b>Name : </b>{{$consultation->patient->pre_name}} {{$consultation->patient->fname}} {{$consultation->patient->lname}} </li>
                  <li class="list-group-item"><b>Gender : </b>{{$consultation->patient->gender}} </li>
                  <li class="list-group-item"><b>Age : </b>{{$consultation->patient->age}} </li>
                  <li class="list-group-item"><b>Height : </b>{{$consultation->patient->height}} (Fit.inchi)</li>
                  <li class="list-group-item"><b>Wight : </b>{{$consultation->patient->weight}} Kg</li>
                  <li class="list-group-item"><b>Phone : </b>{{$consultation->patient->phone}} </li>
                  <li class="list-group-item"><b>Address : </b>{{$consultation->patient->address}} </li>
                  <li class="list-group-item"><b>Guardian Phone : </b>{{$consultation->patient->guardian_phone}} </li>
                  
                  <li class="list-group-item text-white" aria-current="true" style="background-color: #264E36">
                        @if($consultation->is_complete)
                        Consulted By
                        @else
                        Consulting By
                        @endif
                  </li>
                  <li class="list-group-item"><b>Name : </b>{{$consultation->doctor->user->name}} </li>
                  <li class="list-group-item"><b>Department : </b>{{$consultation->doctor->department->name}} </li>
                  @if($consultation->doctor->qualification)
                        <li class="list-group-item"><b>Qualification : </b>{{$consultation->doctor->qualification}} </li>
                  @endif
                  @if($consultation->doctor->specialization)
                        <li class="list-group-item"><b>Specialization : </b>{{$consultation->doctor->specialization}} </li>
                  @endif
            </ul>
            </div>
            <div class="col-sm">
                  <ul class="list-group">
      
                        <li class="list-group-item bg-dark text-white" aria-current="true">
                              History
                        </li>
                        <li class="list-group-item"><b>Primary Admitting Diagnosis : </b>{{$history->primary_admitting_diagnosis}} </li>
                        <li class="list-group-item"><b>Permanant History : </b>{{$history->permanant_history}} </li>
                        <li class="list-group-item"><b>Previous Medical History : </b>{{$history->previous_medical_history}} </li>
                        <li class="list-group-item"><b>Surgical History : </b>{{$history->surgical_history}} </li>
                        <li class="list-group-item"><b>Smoker : </b>@if($history->smoker==1) Yes @else No @endif </li>
                        <li class="list-group-item"><b>Diabetes : </b>@if($history->diabetes==1) Yes @else No @endif </li>
                        <li class="list-group-item"><b>Heart Rate : </b>{{$history->heart_rate}} </li>
                        <li class="list-group-item"><b>BP Systole : </b>{{$history->bp_systole}} </li>
                        <li class="list-group-item"><b>BP Diastole : </b>{{$history->bp_diastole}} </li>
                        <li class="list-group-item"><b>Oxygen Seturation : </b>{{$history->oxygen_seturation}} </li>
                        <li class="list-group-item"><b>Pain On Scale : </b>@if($history->pain_on_scale==1) Yes @else No @endif </li>
                  </ul>
            </div>
      </div>
      
      <br>
      
      {{-- Prescribe and Medication section start --}}
      <div class="row">
            <div class="col-sm">
                  <ul class="list-group">
                        <li class="list-group-item text-white" aria-current="true" style="background-color:#9B2335">
                              Problem
                        </li>
                        <li class="list-group-item"><b>Details : </b>{{$consultation->problem_details}} </li>
                        <li class="list-group-item"><b>Duration : </b>{{$consultation->problem_duration}} </li>
      
      
                        <li class="list-group-item text-white w3-flat-wet-asphalt" aria-current="true" style="backgro-color:#603cba">
                              Doctor's Prescription
                        </li>
                        @if(!count($consultation->prescribe))
                              <li class="list-group-item" aria-current="true">
                                    Empty
                              </li>
                        @endif
                        @foreach ($consultation->prescribe as $item)
                        <li class="list-group-item">
                              <b>{{$item['title']}} : </b> {{$item['comment']}}
                              @if(!$item['isAllow'])
                              <div class="float-end badge" style="background-color:#9B2335">
                                    Disallowed
                             </div>
                             @endif
                        </li>
                        @endforeach
                  </ul>
            </div>
            <div class="col-sm">
                  <ul class="list-group">
                        <li class="list-group-item text-white" aria-current="true" style="background-color:#55ACEE">
                              Medication
                        </li>
                        <li class="list-group-item"><b>Medication : </b>{{$medication->medication}} </li>
                        <li class="list-group-item"><b>Dose : </b>{{$medication->dose}} </li>
                        <li class="list-group-item"><b>Route : </b>{{$medication->route}} </li>
                        <li class="list-group-item"><b>Frequency : </b>{{$medication->frequency}} </li>
                        <li class="list-group-item"><b>Last Taken : </b>{{$medication->last_taken}} </li>
                  </ul>
            </div>
      </div>
      <br>
      
      
      
      
      {{-- exam section start --}}
      
      
      <ul class="list-group">
            <li class="list-group-item text-white" aria-current="true" style="background-color: #00758F">
                  Given Test
            </li>
            @if(!count($test))
                  <li class="list-group-item" aria-current="true">
                        Empty
                  </li>
            @endif
            @foreach ($test as $item)
                  <li class="list-group-item">
                        
                        <h5>{{$item->test->test_name}} : </h5>
                        @if(!empty($item->report))
                              <a href="{{asset('assets/report/'.$item->report)}}" class="badge btn btn-dark" target="_blank" rel="noopener noreferrer">View</a>  
                        @else
                             <div class="">Didn't Submitted Yet</div>
                        @endif
                        
                        
                  </li>
            @endforeach
      </ul>
      
      <br>
      
      <div class="row">
            <div class="col-sm">
                  <ul class="list-group">
                        <li class="list-group-item text-white" style="background-color:#2F4F4F" aria-current="true">   
                              Doctor's Final Statement
                        </li>
                        <li class="list-group-item">@if($consultation->exam_result){{$consultation->exam_result}} @else Didn't submitted yet @endif</li>
                  </ul>
            </div>
      </div>
      
      <br>

      
      
      
 



      {{-- Content End --}}





@if(Auth::user())                  
                  </div>        
            </main>
      </div>   
</div>
</div>
@endif








<script src="{{asset('bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>



</body>
</html>