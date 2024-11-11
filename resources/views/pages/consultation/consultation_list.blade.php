@extends('layout.lay')

@section('title','Patients')
@section('content')

@if($con_quantity_on_lab>0)
<div class="alert alert-info">
  Your <strong>{{$con_quantity_on_lab}}</strong> patient is on Laboratory
</div>
@else
<div class="alert alert-info">
No patient of your is on Laboratory
</div> 
@endif
<div style="overflow-x:auto;">
<table class="table">
   <thead>
     <tr>
       <th scope="col">ID</th>
       <th scope="col">Patient Name</th>
       <th scope="col">Patient Phone</th>
       <th scope="col">Is New</th>
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
            @if($item['is_examed']==1)
            <div class="badge bg-danger">Old</div>   
            @else
            <div class="badge bg-primary">New</div>   
            @endif
        </td>
         <td>
            <a href="{{url('/consultation-status/'.$item['id'])}}" class="btn mb-1 btn-info">Status</a>
         </td>
         
       </tr>       
      @endforeach

   </tbody>
 </table>
</div>
@endsection