@extends('layout.lay')

@section('title','Patient Registration')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Submit History</h3>
<form method="POST" action="{{url('/submit-history/'.$patient_id)}}">
      @csrf


      <div class="row">
            <div class="col">
            <label for="inputPassword" class="col-form-label"><b>Primary Admitting Diagnosis</b></label>
              <input type="text" name="primary_admitting_diagnosis" class="form-control" 
                  placeholder="Primary Admitting Diagnosis" aria-label="First name" 
                  @if($history->primary_admitting_diagnosis) value="{{$history->primary_admitting_diagnosis}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Permanant History</b></label>
              <input type="text" name="permanant_history" class="form-control" 
                  placeholder="Permanant History" aria-label="First name" 
                  @if($history->permanant_history) value="{{$history->permanant_history}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Previous Medical History</b></label>
              <input type="text" name="previous_medical_history" class="form-control" 
                  placeholder="Previous Medical History" aria-label="First name" 
                  @if($history->previous_medical_history) value="{{$history->previous_medical_history}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Surgical History</b></label>
              <input type="text" name="surgical_history" class="form-control" 
                  placeholder="Surgical History" aria-label="First name" 
                  @if($history->surgical_history) value="{{$history->surgical_history}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">

            <div class="col">
                  <div class="form-check-inline">
                        <b>Smoker:</b> 
                    </div>
                  <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="smoker" value="1" id="flexRadioDefault1" @if($history->smoker==1) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault1">
                          Yes
                        </b></label>
                      </div>
                      <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="smoker" value="0" id="flexRadioDefault2" @if($history->smoker==0) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault2">
                          No
                        </b></label>
                      </div>
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <div class="form-check-inline">
                        <b>Diabetes:</b> 
                    </div>
                  <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="diabetes" value="1" id="flexRadioDefault1" @if($history->diabetes==1) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault1">
                          Yes
                        </b></label>
                      </div>
                      <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="diabetes" value="0" id="flexRadioDefault2" @if($history->diabetes==0) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault2">
                          No
                        </b></label>
                      </div>
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Heart Rate</b></label>
              <input type="text" name="heart_rate" class="form-control" 
                  placeholder="Heart Rate" aria-label="First name" 
                  @if($history->heart_rate) value="{{$history->heart_rate}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>BP Systole</b></label>
              <input type="text" name="bp_systole" class="form-control" 
                  placeholder="BP Systole" aria-label="First name" 
                  @if($history->bp_systole) value="{{$history->bp_systole}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>BP Diastole</b></label>
              <input type="text" name="bp_diastole" class="form-control" 
                  placeholder="BP Diastole" aria-label="First name" 
                  @if($history->bp_diastole) value="{{$history->bp_diastole}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Oxygen Seturation</b></label>
              <input type="text" name="oxygen_seturation" class="form-control" 
                  placeholder="Oxygen Seturation" aria-label="First name" 
                  @if($history->oxygen_seturation) value="{{$history->oxygen_seturation}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <div class="form-check-inline">
                        <b>Pain On Scale:</b> 
                    </div>
                  <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="pain_on_scale" value="1" id="flexRadioDefault1" @if($history->pain_on_scale==1) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault1">
                          Yes
                        </b></label>
                      </div>
                      <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="pain_on_scale" value="0" id="flexRadioDefault2" @if($history->pain_on_scale==0) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault2">
                          No
                        </b></label>
                      </div>
            </div>
      </div>
      <br>



      <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      
</form>
      
</div>




@endsection