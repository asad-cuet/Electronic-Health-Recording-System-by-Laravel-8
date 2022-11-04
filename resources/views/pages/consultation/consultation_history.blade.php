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

    <style>
      nav svg {
               height:20px;
      }    
      ui-menu{
        z-index: 3500!important;
      }        
        
        </style>
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
       <th scope="col">Consulted By</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($consultations as $item)
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item->patient['full_name']}}</td>
         <td>{{$item->patient['phone']}}</td>
         <td>
              @if($item->doctor->user['id']!=Auth::user()->id)
                  <a href="{{url('/doctor-details/'.$item->doctor['id'])}}" class="">{{$item->doctor->user['name']}}</a>
              @else
                  You
              @endif    
        </td>
         <td>
            <a href="{{url('/patient-status/'.$item->patient['history_id'])}}" class="btn btn-info">Status</a>
         </td>
         
       </tr>       
      @endforeach

   </tbody>
 </table>
</div>

<div class="mx-auto align-right">
  {{$consultations->links('.....vendor.pagination.bootstrap-4')}}
 </div>

@endsection