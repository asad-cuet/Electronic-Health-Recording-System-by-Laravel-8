@extends('layout.lay')

@section('title','Patient Registration')
@section('content')


<div class="" style="">
<h3 class="">Patient Registration Form</h3>
<br>
<form method="POST" action="{{url('/add-patient')}}">
      @csrf


      <div class="row">
        <div class="col p-3">
                    <h4>Personal Details</h4>
                    <div class="row">
                      <div class="col">
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Pro">
                          <label class="form-check-label" for="flexRadioDefault1">
                            Pro
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Dr">
                          <label class="form-check-label" for="flexRadioDefault2">
                            Dr
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Mr">
                          <label class="form-check-label" for="flexRadioDefault2">
                            Mr
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Mrs">
                          <label class="form-check-label" for="flexRadioDefault2">
                            Mrs
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="pre_name" value="Miss">
                          <label class="form-check-label" for="flexRadioDefault2">
                            Miss
                          </label>
                        </div>
                       </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <input required type="text" name="fname" class="form-control" placeholder="First Name" aria-label="First name">
                      </div>
                      <div class="col">
                        <input required type="text" name="lname" class="form-control" placeholder="Last Name" aria-label="First name">
                      </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <div class="form-check form-check-inline">
                      <input required class="form-check-input" type="radio" name="gender" value="male">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Male
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input required class="form-check-input" type="radio" name="gender" value="female">
                      <label class="form-check-label" for="flexRadioDefault2">
                        Female
                      </label>
                    </div>
                   </div>
                </div>
                <br>
                <div class="row">
                      <div class="col">
                        <input required type="number" name="age" class="form-control" placeholder="Age" aria-label="First name">
                      </div>
                      <div class="col">
                        <input required type="text" name="height" class="form-control" placeholder="Height (fit.inchi)" aria-label="Last name">
                      </div>
                      <div class="col">
                        <input required type="number" name="weight" class="form-control" placeholder="Weight (Kg)" aria-label="Last name">
                      </div>
                </div>
                <br>
                <div class="row">
                      <div class="col">
                        <input required type="text" name="address" class="form-control" placeholder="Address" aria-label="First name">
                      </div>
                      <div class="col">
                        <input required type="number" name="phone" class="form-control" placeholder="Phone" aria-label="First name">
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
                          <input required class="form-check-input" type="radio" name="health_insurance" value="1">
                          <label class="form-check-label" for="flexRadioDefault1">
                            Yes
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input required class="form-check-input" type="radio" name="health_insurance" value="0">
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
                        <input required type="text" name="guardian_name" class="form-control" placeholder="Guardian Name" aria-label="First name">
                      </div>
                </div>    
                <br>  
                <div class="row">
                  <div class="col">
                    <input required type="number" name="guardian_phone" class="form-control" placeholder="Guardian Phone" aria-label="First name">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <input required type="text" name="relationship" class="form-control" placeholder="Relationship" aria-label="First name">
                  </div>
                </div>
        </div>
      </div>

      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Register</button>
      </div>
      
</form>
      
</div>




@endsection