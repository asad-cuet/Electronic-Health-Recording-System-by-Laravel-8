@extends('layout.lay')

@section('title','Patient Details')
@section('content')


<div class="" style="">
<h3 class="">
  Patient Details
  <a href="{{url('/patient-status/'.$patient['history_id'])}}" class="btn badge" style="background-color:#D69C2F">Status</a>
</h3>

<br>
<form method="POST" action="{{url('/update-patient/'.$patient->id)}}">
      @csrf


      <div class="row">
        <div class="col p-3">
                    <h4>Personal Details</h4>
                    <div class="row">
                      <div class="col">
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Pro" @if($patient->pre_name=='Pro') checked @endif>
                          <label class="form-check-label" for="flexRadioDefault1">
                            Pro
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Dr" @if($patient->pre_name=='Dr') checked @endif>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Dr
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Mr" @if($patient->pre_name=='Mr') checked @endif>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Mr
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Mrs" @if($patient->pre_name=='Mrs') checked @endif>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Mrs
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Miss" @if($patient->pre_name=='Miss') checked @endif>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Miss
                          </label>
                        </div>
                       </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>First Name</b></label>
                        <input required type="text" name="fname" value="{{$patient->fname}}" class="form-control" placeholder="First Name" aria-label="First name">
                      </div>
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Last Name</b></label>
                        <input required type="text" name="lname" value="{{$patient->fname}}" class="form-control" placeholder="Last Name" aria-label="First name">
                      </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <label for="inputPassword" class="col-form-label"><b>Gender</b></label>
                    <div class="form-check form-check-inline">
                      <input required class="form-check-input" type="radio" name="gender" value="male" @if($patient->gender=='male') checked @endif>
                      <label class="form-check-label" for="flexRadioDefault1">
                        Male
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input required class="form-check-input" type="radio" name="gender" value="female" @if($patient->gender=='female') checked @endif>
                      <label class="form-check-label" for="flexRadioDefault2">
                        Female
                      </label>
                    </div>
                   </div>
                </div>
                <br>
                <div class="row">
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Age</b></label>
                        <input required type="number" name="age" value="{{$patient->age}}" class="form-control" placeholder="Age" aria-label="First name">
                      </div>
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Height (fit.inchi)</b></label>
                        <input required type="text" name="height" value="{{$patient->height}}" class="form-control" placeholder="Height (fit.inchi)" aria-label="Last name">
                      </div>
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Weight (kg)</b></label>
                        <input required type="number" name="weight" value="{{$patient->weight}}" class="form-control" placeholder="Weight (Kg)" aria-label="Last name">
                      </div>
                </div>
                <br>
                <div class="row">
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Address</b></label>
                        <input required type="text" name="address" value="{{$patient->address}}" class="form-control" placeholder="Address" aria-label="First name">
                      </div>
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Contact</b></label>
                        <input required type="number" name="phone" value="{{$patient->phone}}" class="form-control" placeholder="Phone" aria-label="First name">
                      </div>
                </div>
                <br>
                <div class="row">
                      <div class="col">
                        <div class="form-check-inline">
                          <label class="form-check-label text-left" for="flexRadioDefault1">
                            <b>Health Insurance</b> 
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="health_insurance" value="1" @if($patient->health_insurance=='1') checked @endif>
                          <label class="form-check-label" for="flexRadioDefault1">
                            Yes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="health_insurance" value="0" @if($patient->health_insurance=='0') checked @endif>
                          <label class="form-check-label" for="flexRadioDefault1">
                            No
                          </label>
                        </div>
                       </div>
                </div>

        </div>
        <div class="col p-3">
                <h4>Emergency Contact</h4>
                <div class="row">
                      <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Guardian Name</b></label>
                        <input required type="text" name="guardian_name" value="{{$patient->guardian_name}}" class="form-control" placeholder="Guardian Name" aria-label="First name">
                      </div>
                </div>    
                <br>  
                <div class="row">
                  <div class="col">
                    <label for="inputPassword" class="col-form-label"><b>Contacts</b></label>
                    <input required type="number" name="guardian_phone" value="{{$patient->guardian_phone}}" class="form-control" placeholder="Guardian Phone" aria-label="First name">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <label for="inputPassword" class="col-form-label"><b>Relationship</b></label>
                    <input required type="text" name="relationship" value="{{$patient->relationship}}" class="form-control" placeholder="Relationship" aria-label="First name">
                  </div>
                </div>
        </div>
      </div>

      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
      </div>
      
</form>
      
</div>




@endsection