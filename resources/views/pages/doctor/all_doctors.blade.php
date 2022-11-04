@extends('layout.lay')

@section('title','Doctors')
@section('content')


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
            <a href="{{url('/doctor-details/'.$item['id'])}}" class="btn btn-secondary">View</a>
         </td>
         
       </tr>       
      @endforeach

   </tbody>
 </table>
</div>
@endsection