@extends('layout.lay')

@section('title','Profile')

@section('css')
<style>

</style>

@endsection
@section('content')

<div style="overflow-x:auto">


<div class="" style="width:100%;max-width:700px;margin:auto">
      <h3 class="">Profile</h3>
      <form method="POST" action="{{url('/update-profile')}}">
            @csrf
            <div class="row">
              <div class="col">
                <b>Department: </b>{{Auth::user()->doctor->department->name}}
              </div>
            </div>
              <div class="row">
                    <div class="col">
                        <label for="inputPassword" class="col-form-label"><b>Name</b></label>
                      <input required type="text" name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Full Name" aria-label="First name">
                    </div>
              </div>
              <br>
              <div class="row">
                    <div class="col">
                      <label for="inputPassword" class="col-form-label"><b>Email</b></label>
                      <input required type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Specializaton" aria-label="First name">
                    </div>
              </div>
              <br>
              <div class="row">
                  <div class="col">
                    <label for="inputPassword" class="col-form-label"><b>Qualification</b></label>
                    <input required type="text" name="qualification" value="{{Auth::user()->doctor->qualification}}" class="form-control" placeholder="Specializaton" aria-label="First name">
                  </div>
            </div>
              <br>
              <div class="row">
                  <div class="col">
                    <label for="inputPassword" class="col-form-label"><b>Specialization</b></label>
                    <input required type="text" name="specialization" value="{{Auth::user()->doctor->specialization}}" class="form-control" placeholder="Specializaton" aria-label="First name">
                  </div>
            </div>
            <br>
            <div class="row">
                  <div class="col">
                    <label for="inputPassword" class="col-form-label"><b>Contact</b></label>
                    <input required type="number" name="phone" value="{{Auth::user()->doctor->phone}}" class="form-control" placeholder="Specializaton" aria-label="First name">
                  </div>
            </div>
              <br>
              <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
              </div>
            
      </form>
            
      <br>
      
      </div>
</div>      

@endsection