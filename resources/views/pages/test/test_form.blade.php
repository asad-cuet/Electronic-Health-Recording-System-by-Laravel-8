@extends('layout.lay')

@section('title','Patient Registration')
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Add Test</h3>
<form method="POST" action="{{url('/add-test')}}">
      @csrf


      <div class="row">
            <div class="col">
              <input required type="text" name="test_name" class="form-control" placeholder="Write Name.." aria-label="First name">
            </div>
      </div>
      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Add</button>
      </div>
      
</form>
      
</div>




@endsection