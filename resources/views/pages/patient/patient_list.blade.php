@extends('layout.lay')

@section('title','Patients')

@section('css')
<style>
  nav svg {
           height:20px;
  }
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
  <form action="{{url('/search-patient')}}" method="POST">
    @csrf
  <div class="input-group">
    <input required type="search" class="form-control" name="searched_key" id="auto_complete" placeholder="Seach Patient.." aria-label="Username" aria-describedby="basic-addon1">          
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
       <th scope="col">Gender</th>
       <th scope="col">Age</th>
       <th scope="col">Weight</th>
       <th scope="col">Phone</th>
       <th scope="col">Status</th>
       <th scope="col">Date</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($patients as $item)
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item['pre_name']}} {{$item['fname']}} {{$item['lname']}}</td>
         <td>{{$item['gender']}}</td>
         <td>{{$item['age']}}</td>
         <td>{{$item['weight']}}</td>
         <td>{{$item['phone']}}</td>
         <td>
          @if($item['is_cleared'])
          <div class="badge  bg-success">Consultation Completed</div>
          <a href="{{url('/patient-status/'.$item['history_id'])}}" class="btn badge" style="background-color:#D69C2F">Status</a>
          @else
              @if(!$item['is_consulted'])
                  <div class="badge  bg-danger">Not Consulted</div>    
              @else
                  <div class="badge  bg-dark">Consulted</div>   
                  <a href="{{url('/patient-status/'.$item['history_id'])}}" class="btn badge" style="background-color:#D69C2F">Status</a> 
              @endif
          @endif
        </td>
        <td>
          {{date('d/m/Y h:i a',strtotime($item['created_at']))}}
        </td>
         <td>
            <a href="{{url('/patient-view/'.$item['id'])}}" class="btn btn-secondary">View</a>
            @if(!$item['is_consulted'])
            <a href="{{url('/consultant/'.$item['id'])}}" class="btn btn-primary">Consultant To</a>
            @endif
         </td>
         
       </tr>       
      @endforeach

   </tbody>
 </table>
 <div class="mx-auto align-right">
  {{$patients->links('.....vendor.pagination.bootstrap-4')}}
 </div>
 
</div>
@endsection