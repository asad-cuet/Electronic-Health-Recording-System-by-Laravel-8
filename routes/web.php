<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

//when there is 0 user in database, this url will create a user. It can be use just for one timr
Route::get('/create', function () {
  if(App\Models\User::count()==0)
  {
    $pass=12345678;
    $data=[
      'name'=>'Administration',
      'email'=>'ad@gmail.com',
      'rolse_as'=>'administration',
      'password'=>Hash::make($pass)
    ];
    App\Models\User::create($data);
    return "A user created. Email: ad@gmail.com and password: ".$pass.".<br>This way can be use only One time at the begining of the website.";
  }
  else
  {
    return "Sorry! <br>This way is available just for 1 time";
  }
});


Auth::routes([
    'register' => true, // Registration Routes...
  ]);
//Auth::routes();


//can access without login
Route::get('/patient-status/{history_id}', [App\Http\Controllers\PatientController::class, 'patient_status'])->name('patient_status');

// all auth can access
Route::middleware(['auth'])->group(function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'update_profile'])->name('update_profile');
Route::get('/test', [App\Http\Controllers\HomeController::class, 'xlsx'])->name('test');
});


//only administration can access
Route::middleware(['auth','isAdministration'])->group(function () {
Route::get('/patients', [App\Http\Controllers\PatientController::class, 'patients'])->name('patients');
Route::get('/patient-form', [App\Http\Controllers\PatientController::class, 'patient_form'])->name('patient_form');
Route::post('/add-patient', [App\Http\Controllers\PatientController::class, 'add_patient'])->name('add_patient');
Route::get('/patient-view/{id}', [App\Http\Controllers\PatientController::class, 'patient_view'])->name('patient_view');
Route::post('/update-patient/{id}', [App\Http\Controllers\PatientController::class, 'patient_update'])->name('patient_update');
Route::get('/consultant/{id}', [App\Http\Controllers\PatientController::class, 'consultant'])->name('consultant');
Route::post('/consultant-to/{patient_id}', [App\Http\Controllers\PatientController::class, 'consultant_to'])->name('consultant_to');

Route::get('/all-user', [App\Http\Controllers\AdministrationController::class, 'all_user'])->name('all_user');
Route::get('/delete-user/{user_id}', [App\Http\Controllers\AdministrationController::class, 'delete_user'])->name('delete_user');

Route::get('/doctors', [App\Http\Controllers\DoctorController::class, 'doctors'])->name('doctors');
Route::get('/doctor-form', [App\Http\Controllers\DoctorController::class, 'doctor_form'])->name('doctor_form');
Route::post('/add-doctor', [App\Http\Controllers\DoctorController::class, 'add_doctor'])->name('add_doctor');
Route::get('/doctor-view/{id}', [App\Http\Controllers\DoctorController::class, 'doctor_view'])->name('doctor_view');
Route::post('/update-doctor/{id}', [App\Http\Controllers\DoctorController::class, 'doctor_update'])->name('doctor_update');


Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'departments'])->name('departments');
Route::get('/department-form', [App\Http\Controllers\DepartmentController::class, 'department_form'])->name('department_form');
Route::post('/add-department', [App\Http\Controllers\DepartmentController::class, 'add_department'])->name('add_department');


Route::get('/tests', [App\Http\Controllers\TestController::class, 'tests'])->name('tests');
Route::get('/test-form', [App\Http\Controllers\TestController::class, 'test_form'])->name('test_form');
Route::post('/add-test', [App\Http\Controllers\TestController::class, 'add_test'])->name('add_test');



Route::post('/search-user', [App\Http\Controllers\SearchController::class, 'search_user'])->name('search_user');
Route::post('/search-patient', [App\Http\Controllers\SearchController::class, 'search_patient'])->name('search_user');
Route::post('/search-doctor', [App\Http\Controllers\SearchController::class, 'search_doctor'])->name('search_doctor');




//Export section

Route::get('/export', [App\Http\Controllers\ExportController::class, 'home']);

Route::get('/export/users/xlsx', [App\Http\Controllers\ExportController::class, 'export_xlsx']);
Route::get('/export/users/csv', [App\Http\Controllers\ExportController::class, 'export_csv']);

Route::get('/export/patient/xlsx', [App\Http\Controllers\ExportController::class, 'patient_xlsx']);
Route::get('/export/patient/csv', [App\Http\Controllers\ExportController::class, 'patient_csv']);

Route::get('/export/clinical/history/xlsx', [App\Http\Controllers\ExportController::class, 'clinical_history_xlsx']);
Route::get('/export/clinical/history/csv', [App\Http\Controllers\ExportController::class, 'clinical_history_csv']);

Route::get('/export/medication/xlsx', [App\Http\Controllers\ExportController::class, 'medication_xlsx']);
Route::get('/export/medication/csv', [App\Http\Controllers\ExportController::class, 'medication_csv']);

Route::get('/export/consultation/xlsx', [App\Http\Controllers\ExportController::class, 'consultation_xlsx']);
Route::get('/export/consultation/csv', [App\Http\Controllers\ExportController::class, 'consultation_csv']);

Route::get('/export/exam/xlsx', [App\Http\Controllers\ExportController::class, 'exam_xlsx']);
Route::get('/export/exam/csv', [App\Http\Controllers\ExportController::class, 'exam_csv']);

Route::get('/export/prescribe/xlsx', [App\Http\Controllers\ExportController::class, 'prescribe_xlsx']);
Route::get('/export/prescribe/csv', [App\Http\Controllers\ExportController::class, 'prescribe_csv']);

Route::get('/export/doctor/xlsx', [App\Http\Controllers\ExportController::class, 'doctor_xlsx']);
Route::get('/export/doctor/csv', [App\Http\Controllers\ExportController::class, 'doctor_csv']);

Route::get('/export/department/xlsx', [App\Http\Controllers\ExportController::class, 'department_xlsx']);
Route::get('/export/department/csv', [App\Http\Controllers\ExportController::class, 'department_csv']);

Route::get('/export/comment/xlsx', [App\Http\Controllers\ExportController::class, 'comment_xlsx']);
Route::get('/export/comment/csv', [App\Http\Controllers\ExportController::class, 'comment_csv']);


});

//only doctor can access
Route::middleware(['auth','isDoctor'])->group(function () {
Route::get('/consultations', [App\Http\Controllers\ConsultationController::class, 'consultations'])->name('consultations');
Route::get('/consultations-on-lab', [App\Http\Controllers\ConsultationController::class, 'consultations_on_lab'])->name('consultations_on_lab');
Route::get('/consultation-status/{id}', [App\Http\Controllers\ConsultationController::class, 'consultation_status'])->name('consultation_status');


Route::get('/consultant-complete/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'consultant_complete'])->name('consultant_complete');
Route::get('/consultation-history', [App\Http\Controllers\OthersConsultationController::class, 'patient_history'])->name('patient_history');
Route::post('/consultation/search-history', [App\Http\Controllers\SearchController::class, 'search_con_history'])->name('search_doctor');

Route::get('/problem/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'problem'])->name('problem');
Route::post('/submit-problem/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'submit_problem'])->name('submit_problem');

Route::get('/prescribe/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'prescribe'])->name('prescribe');
Route::post('/submit-prescribe/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'submit_prescribe'])->name('submit_prescribe');
Route::get('/prescribe-disallow/{presc_id}',[App\Http\Controllers\ConsultationController::class, 'prescribe_disallow'])->name('prescribe_disallow');

Route::get('/history/{patient_id}', [App\Http\Controllers\ConsultationController::class, 'history'])->name('history');
Route::post('/submit-history/{patient_id}', [App\Http\Controllers\ConsultationController::class, 'submit_history'])->name('submit_history');

Route::get('/medication/{patient_id}', [App\Http\Controllers\ConsultationController::class, 'medication'])->name('medication');
Route::post('/submit-medication/{patient_id}', [App\Http\Controllers\ConsultationController::class, 'submit_medication'])->name('submit_medication');



Route::get('/exam-result/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'exam_result'])->name('exam_result');
Route::post('/submit-exam-result/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'submit_exam_result'])->name('submit_exam_result');



Route::get('/exam/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'exam'])->name('exam');
Route::post('/submit-exam/{consultation_id}', [App\Http\Controllers\ConsultationController::class, 'submit_exam'])->name('submit_exam');


Route::get('/lab-resend/{exam_id?}/{consultaion_id?}', [App\Http\Controllers\ConsultationController::class,'lab_resend'])->name('lab_resend');


Route::get('/consultations-others', [App\Http\Controllers\OthersConsultationController::class, 'consultations_others'])->name('consultations_others');
Route::post('/doctor-comment/{exam_id?}/{consultation_id?}', [App\Http\Controllers\CommentController::class, 'doctor_comment'])->name('doctor_comment');
Route::get('/commented-doctor-view/{doctor_id?}', [App\Http\Controllers\CommentController::class, 'doctor_view'])->name('doctor_view');

Route::get('/all-doctors', [App\Http\Controllers\DoctorController::class, 'all_doctors'])->name('all_doctors');
Route::get('/doctor-details/{id?}', [App\Http\Controllers\DoctorController::class, 'doctor_details'])->name('doctor_details');


Route::post('doctor-comment-to-lab/{exam_id}', [App\Http\Controllers\LabController::class,'doctor_comment_to_lab'])->name('doctor_comment_to_lab');

});

//only lab tecknician can access
Route::middleware(['auth','isLab_tecknician'])->group(function () {
Route::get('/lab', [App\Http\Controllers\LabController::class, 'lab'])->name('lab');
Route::get('/lab-view/{consultation_id}', [App\Http\Controllers\LabController::class,'lab_view'])->name('lab_view');
Route::get('/lab-clear/{consultation_id}', [App\Http\Controllers\LabController::class,'lab_clear'])->name('lab_clear');
Route::post('/lab-comment/{exam_id}', [App\Http\Controllers\LabController::class,'lab_comment'])->name('lab_comment');
Route::post('/lab-update/{exam_id?}', [App\Http\Controllers\LabController::class, 'lab_update'])->name('lab_update');
Route::get('/lab-delete/{exam_id?}/{consultation_id}/{test_id}', [App\Http\Controllers\LabController::class, 'lab_delete'])->name('lab_delete');
Route::post('/submit-report/{consultation_id}', [App\Http\Controllers\LabController::class, 'submit_report'])->name('submit_report');

});


