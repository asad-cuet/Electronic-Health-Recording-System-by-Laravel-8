@extends('layout.lay')

@section('title','Patients')
@section('content')

<div style="overflow-x:auto;">
<table class="table">
   <thead>
     <tr>
       <th scope="col">ID</th>
       <th scope="col">Patient Name</th>
       <th scope="col">Patient Phone</th>
       <th scope="col">Consulting By</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($consultations as $item)
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item['patient_name']}}</td>
         <td>{{$item['patient_phone']}}</td>
         <td>{{$item['doctor_name']}}</td>
         <td>
            <a href="{{url('/consultation-status/'.$item['id'])}}" class="btn btn-info">Status</a>
         </td>
         
       </tr>       
      @endforeach

   </tbody>
 </table>
</div>
@endsection