@extends('layout.lay')

@section('title','Patient View')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="">Doctor's Details</h3>
<form method="POST" action="{{url('/update-doctor/'.$doctor->id)}}">
      @csrf

            <div class="row">
              <div class="col">
              <b>Department Name: </b>{{$doctor->department->name}} <br>
              <b>Doctor Email: </b>{{$doctor->user->email}}
              </div>
        </div>
        <br>
        <div class="row">
              <div class="col">
                  <label for="inputPassword" class="col-form-label"><b>Name</b></label>
                <input required type="text" name="name" value="{{$doctor->user->name}}" class="form-control" placeholder="Full Name" aria-label="First name">
              </div>
        </div>
        <br>
        <div class="row">
              <div class="col">
                <label for="inputPassword" class="col-form-label"><b>Specialization</b></label>
                <input required type="text" name="specialization" value="{{$doctor->specialization}}" class="form-control" placeholder="Specializaton" aria-label="First name">
              </div>
        </div>
        <br>
        <div class="row">
              <div class="col">
                <label for="inputPassword" class="col-form-label"><b>Qualification</b></label>
                <input required type="text" name="qualification" value="{{$doctor->qualification}}" class="form-control" placeholder="Qualification" aria-label="First name">
              </div>
        </div>
        <br>
        <div class="row">
              <div class="col">
                <label for="inputPassword" class="col-form-label"><b>Contact</b></label>  
                <input required type="number" name="phone" value="{{$doctor->phone}}" class="form-control" placeholder="Phone" aria-label="First name">
              </div>
        </div>
        <br>
        <div class="text-center">
              <button type="submit" class="btn btn-primary">Update</button>
        </div>
      
</form>
      
<br>

</div>




@endsection