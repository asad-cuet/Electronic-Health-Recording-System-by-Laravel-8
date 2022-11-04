@extends('layout.lay')

@section('title','Export')

@section('css')
<style>
      .hover-red:hover {
        color:red!important;
      }
      .hover-other:hover {
        color:rgb(0, 255, 213)!important;
      }
      .hover-dark:hover {
        color:rgb(30, 40, 148)!important;
      }

      .bg-color-1 {
            background-color:#D69C2F!important;
      }
      .hover-bg-color-1:hover {
            color:#D69C2F!important;
      }
      .bg-color-2 {
            background-color: #264E36!important;
      }
      .bg-color-3 {
            background-color:#9B2335!important;
      }
      .bg-color-4 {
            background-color:#9B1B30!important;
      }
      .bg-color-7 {
            background-color:#55ACEE!important;
      }

      .bg-color-5 {
            background-color:#00758F!important;
      }
      .hover-bg-color-5:hover {
            color:#00758F!important;
      }
      .bg-color-6 {
            background-color:#2F4F4F!important;
      }
  </style> 
@endsection
@section('content')

<div style="max-width:500px;width:100%;margin:auto">


<div class="row">
      <div class="col-sm">
            <ul class="list-group">
                  <li class="list-group-item active">
                        Export Table
                  </li>
                  <li class="list-group-item">
                        users
                        <div class="float-end">
                              <a href="{{url('/export/users/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/users/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>
                  <li class="list-group-item">
                        patients
                        <div class="float-end">
                              <a href="{{url('/export/patient/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/patient/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>
                  <li class="list-group-item">
                        clinical_histories
                        <div class="float-end">
                              <a href="{{url('/export/clinical/history/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/clinical/history/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>
                  <li class="list-group-item">
                        medications
                        <div class="float-end">
                              <a href="{{url('/export/medication/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/medication/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>

                  <li class="list-group-item">
                        consultations
                        <div class="float-end">
                              <a href="{{url('/export/consultation/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/consultation/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>
                  <li class="list-group-item">
                        exams
                        <div class="float-end">
                              <a href="{{url('/export/exam/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/exam/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>

                  <li class="list-group-item">
                        prescribes
                        <div class="float-end">
                              <a href="{{url('/export/prescribe/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/prescribe/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>
                  <li class="list-group-item">
                        doctors
                        <div class="float-end">
                              <a href="{{url('/export/doctor/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/doctor/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>
                  <li class="list-group-item">
                        departments
                        <div class="float-end">
                              <a href="{{url('/export/department/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/department/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>


                  <li class="list-group-item">
                        comments
                        <div class="float-end">
                              <a href="{{url('/export/comment/csv')}}" class="btn badge bg-color-7">CSV</a>
                              <a href="{{url('/export/comment/xlsx')}}" class="btn badge bg-color-2 hover-bg-color-1">XLSX</a>
                        </div>
                  </li>
                </ul>
      </div>
</div>


</div>

@endsection