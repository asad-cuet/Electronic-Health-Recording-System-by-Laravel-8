@extends('layout.lay')

@section('title','Patient Registration')
@section('css')
<script>
      $(document).ready(function(){
            var cnt=2;
        $("#add").click(function(){
            var col="<div id='row"+cnt+"'><br><div class='row'><div class='col'><input required type='text' name='title[]' class='form-control' placeholder='Title' aria-label='First name'></div><div class='col'><input required type='text' name='comment[]' class='form-control' placeholder='Comment' aria-label='First name'></div></div></div>";
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
<h3 class="text-center">Submit Prescribe</h3>
<form method="POST" action="{{url('/submit-prescribe/'.$consultation_id)}}">
      @csrf

<div class="box">

      <div id="row1">
      <div class="row" >
            <div class="col">
              <input required type="text" name="title[]" class="form-control" placeholder="Title" aria-label="First name">
            </div>
            <div class="col">
              <input required type="text" name="comment[]" class="form-control" placeholder="Comment" aria-label="First name">
            </div>
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