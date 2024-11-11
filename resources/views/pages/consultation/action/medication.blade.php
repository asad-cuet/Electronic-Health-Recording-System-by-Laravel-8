@extends('layout.lay')

@section('title','Patient Registration')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Submit History</h3>
<form method="POST" action="{{url('/submit-medication/'.$patient_id)}}">
      @csrf


      <div class="row">
            <div class="col">
            <label for="inputPassword" class="col-form-label"><b>Medication</b></label>
              <input type="text" name="medication" class="form-control" 
                  placeholder="Medication" aria-label="First name" 
                  @if($medication->medication) value="{{$medication->medication}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Dose</b></label>
              <input type="text" name="dose" class="form-control" 
                  placeholder="Dose" aria-label="First name" 
                  @if($medication->dose) value="{{$medication->dose}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Route</b></label>
              <input type="text" name="route" class="form-control" 
                  placeholder="Route" aria-label="First name" 
                  @if($medication->route) value="{{$medication->route}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Frequency</b></label>
              <input type="text" name="frequency" class="form-control" 
                  placeholder="Frequency" aria-label="First name" 
                  @if($medication->frequency) value="{{$medication->frequency}}" @endif
               />
            </div>
      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Last Taken</b></label>
              <input type="text" name="last_taken" class="form-control" 
                  placeholder="Last Taken" aria-label="First name" 
                  @if($medication->last_taken) value="{{$medication->last_taken}}" @endif
               />
            </div>
      </div>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      
</form>
      
</div>




@endsection