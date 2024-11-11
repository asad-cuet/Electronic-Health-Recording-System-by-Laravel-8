@extends('layout.lay')

@section('title','Profile')

@section('css')
<style>

</style>

@endsection
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
      <h3 class="">Profile</h3>
      <form method="POST" action="{{url('/update-profile')}}">
            @csrf
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
              <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
              </div>
            
      </form>
            
      <br>
      
      </div>

@endsection