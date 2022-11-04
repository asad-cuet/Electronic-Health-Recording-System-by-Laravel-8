@extends('layout.lay')

@section('title','Department Registration')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Add Department</h3>
<form method="POST" action="{{url('/add-department')}}">
      @csrf


      <div class="row">
            <div class="col">
              <input required type="text" name="name" class="form-control" placeholder="Department Name.." aria-label="First name">
            </div>
      </div>
      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Add</button>
      </div>
      
</form>
      
</div>




@endsection