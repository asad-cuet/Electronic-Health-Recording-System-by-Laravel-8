@extends('layout.lay')

@section('title','Patient Registration')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Submit Problem</h3>
<form method="POST" action="{{url('/submit-problem/'.$consultation_id)}}">
      @csrf

      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Problem Details</b></label>
              <textarea required type="text"  name="problem_details" class="form-control" placeholder="Write Problems..." aria-label="First name">@if($consultation->problem_details){{$consultation->problem_details}}@endif</textarea>
            </div>

      </div>
      <br>
      <div class="row">
            <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Duration</b></label>
              <input required type="text" name="problem_duration" class="form-control" placeholder="Problem Duration" aria-label="First name" @if($consultation->problem_details) value="{{$consultation->problem_duration}}" @endif>
            </div>
      </div>
      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      
</form>
      
</div>




@endsection