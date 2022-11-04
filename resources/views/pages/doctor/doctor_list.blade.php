@extends('layout.lay')

@section('title','Doctors')

@section('css')
<style>
.search-bar {
  max-width:400px;
  width:100%;
  margin: auto;
}
/*autocomplete var */

ui-menu{
  z-index: 3500!important;
}        
  
  </style>

@endsection


@section('content')

<!-- Search box -->
<div class="search-bar mx-auto">
<form action="{{url('/search-doctor')}}" method="POST">
  @csrf
<div class="input-group">
  <input required type="search" class="form-control" name="searched_key" id="auto_complete" placeholder="Seach Doctor.." aria-label="Username" aria-describedby="basic-addon1">          
  <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
</div>
</form>
</div>
{{-- Search bar ended --}}


<div style="overflow-x:auto;">
<table class="table">
   <thead>
     <tr>
       <th scope="col">ID</th>
       <th scope="col">Name</th>
       <th scope="col">Department</th>
       <th scope="col">Phone</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($doctors as $item)
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item['name']}}</td>
         <td>{{$item['department_name']}}</td>
         <td>{{$item['phone']}}</td>
         <td>
            <a href="{{url('/doctor-view/'.$item['id'])}}" class="btn btn-secondary">View</a>
         </td>
         
       </tr>       
      @endforeach

   </tbody>
 </table>

</div>
@endsection