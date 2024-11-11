@extends('layout.lay')

@section('title','Patients')

@section('css')
{{-- <style>
  .search-bar {
    max-width:400px;
  width:100%;
  margin: auto;
  }
  /*autocomplete var */

  ui-menu{
    z-index: 3500!important;
  }        
    
    </style> --}}

@endsection


@section('content')


@if($history_view) 

     <!-- Search box -->
{{-- <div class="search-bar mx-auto">
  <form action="{{url('/consultation/search-history')}}" method="POST">
    @csrf
  <div class="input-group">
    <input required type="search" class="form-control" name="searched_key" id="auto_complete" placeholder="Seach Patient.." aria-label="Username" aria-describedby="basic-addon1">          
    <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
  </div>
  </form>
</div> --}}
{{-- Search bar ended --}}

@endif
<div style="overflow-x:auto;">
<table class="table">
   <thead>
     <tr>
       <th scope="col">ID</th>
       <th scope="col">Patient Name</th>
       <th scope="col">Patient Phone</th>
       <th scope="col">@if($history_view) Consulted By  @else Consulting By @endif</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($consultations as $item)
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item['patient_name']}}</td>
         <td>{{$item['patient_phone']}}</td>
         <td>
          <a href="{{url('/doctor-details/'.$item['doctor_id'])}}" class="">{{$item['doctor_name']}}</a>
        </td>
         <td>
            <a href="{{url('/consultation-status/'.$item['id'])}}" class="btn btn-info">Status</a>
         </td>
         
       </tr>       
      @endforeach

   </tbody>
 </table>
</div>

@endsection