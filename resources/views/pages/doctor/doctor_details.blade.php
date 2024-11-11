@extends('layout.lay')

@section('title',"Doctor's Details")
@section('content')



<ul class="list-group">
      <li class="list-group-item active">Doctor's Details</li>
      <li class="list-group-item"><b>Name:</b> {{$doctor->user->name}}</li>
      <li class="list-group-item"><b>Email:</b> {{$doctor->user->email}}</li>
      <li class="list-group-item"><b>Phone:</b> {{$doctor->phone}}</li>
      <li class="list-group-item"><b>Department:</b> {{$doctor->department->name}}</li>
      <li class="list-group-item"><b>Qualification:</b> {{$doctor->qualification}}</li>
      <li class="list-group-item"><b>Specialization:</b> {{$doctor->specialization}}</li>
    </ul>

@endsection