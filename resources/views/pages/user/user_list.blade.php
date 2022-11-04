@extends('layout.lay')

@section('title','All Users')

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
  <form action="{{url('/search-user')}}" method="POST">
    @csrf
  <div class="input-group">
    <input required type="search" class="form-control" name="searched_key" id="auto_complete" placeholder="Seach User.." aria-label="Username" aria-describedby="basic-addon1">          
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
       <th scope="col">Email</th>
       <th scope="col">Role As</th>
       <th scope="col">Action</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($user as $item)
      @if($item['role_as']!='doctor')
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item['name']}}</td>
         <td>{{$item['email']}}</td>
         <td>{{$item['role_as']}}</td>
         <td>
            <a href="{{url('/delete-user/'.$item['id'])}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
         </td>
         
       </tr>
       @endif       
      @endforeach

   </tbody>
 </table>
</div>
@endsection