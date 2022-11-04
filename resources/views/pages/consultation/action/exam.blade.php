@extends('layout.lay')

@section('title','Patient Registration')
@section('css')
<script>
      $(document).ready(function(){
            var cnt=2;
        $("#add").click(function(){
            var col="<div id='row"+cnt+"'><br><div class='row' ><select name='test[]' class='form-select' aria-label='Default select example'><option selected>Open this select menu</option>@foreach ($tests as $item)<option value='{{$item['id']}}'>{{$item['test_name']}}</option>@endforeach</select></div></div>";
            $(".box").append(col);
            cnt++;
        });
        $("#remove").click(function(){
            cnt--;
            var id="#row"+cnt;
            $(id).remove();
        });
      });
</script>
@endsection
@section('content')


<div class="" style="width:100%;max-width:700px;margin:auto">
<h3 class="text-center">Submit Test</h3>
<form method="POST" action="{{url('/submit-exam/'.$consultation_id)}}">
      @csrf

<div class="box">

      <div id="row1">
      <div class="row" >
            <select name="test[]" class="form-select" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  @foreach ($tests as $item)
                  <option value="{{$item['id']}}">{{$item['test_name']}}</option>
                  @endforeach
            </select>
      </div>
</div>

</div>      


      <br>
      <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      
</form>
<button class="btn btn-dark" id="add">Append an Input</button> 
<button class="btn btn-danger" id="remove">Remove an Input</button> 
</div>




@endsection