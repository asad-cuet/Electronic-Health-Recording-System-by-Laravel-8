@extends('layout.lay')

@section('title','Patient Registration')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Submit Exam Result</h3>
<form method="POST" action="{{url('/submit-exam-result/'.$consultation_id)}}">
      @csrf

      <div class="row">
            <div class="col">
              <textarea required type="text"  name="exam_result" class="form-control" placeholder="Write Problems..." aria-label="First name">@if($result){{$result}}@endif</textarea>
            </div>

      </div>
      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      
</form>
      
</div>




@endsection