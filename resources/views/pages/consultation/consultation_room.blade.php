@extends('layout.lay')

@section('title','Patient View')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Choose a doctor to consultant</h3>
<br>
<form method="POST" action="{{url('/consultant-to/'.$patient_id)}}">
      @csrf
      <select class="form-select" name="doctor_id" aria-label="Default select example">
            <option value="0" selected>Select Dector for consultation</option>
            @foreach ($doctors as $item)
                   <option value="{{$item['doctor_id']}}">
                        <b>Name:</b>{{$item['name']}} 
                        <b>Department:</b>{{$item['department']}}
                  </option>               
            @endforeach
      </select>
      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Send to Consultation</button>
      </div>
</form>
</div>


@endsection