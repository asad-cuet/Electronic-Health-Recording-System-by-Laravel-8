<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\PatientExport;
use App\Exports\ClinicalHistoryExport;
use App\Exports\MedicationExport;
use App\Exports\ConsultationExport;
use App\Exports\ExamExport;
use App\Exports\PrescribeExport;
use App\Exports\DoctorExport;
use App\Exports\DepartmentExport;
use App\Exports\CommentExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function home()
    {
        return view('pages.export.home');
    }

    public function export_xlsx() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function export_csv() 
    {
        return Excel::download(new UsersExport, 'users.csv');
    }

    public function patient_xlsx() 
    {
        return Excel::download(new PatientExport, 'patients.xlsx');
    }
    public function patient_csv() 
    {
        return Excel::download(new PatientExport, 'patients.csv');
    }

    public function clinical_history_xlsx() 
    {
        return Excel::download(new ClinicalHistoryExport, 'clinical_histories.xlsx');
    }
    public function clinical_history_csv() 
    {
        return Excel::download(new ClinicalHistoryExport, 'clinical_histories.csv');
    }

    public function medication_xlsx() 
    {
        return Excel::download(new MedicationExport, 'medications.xlsx');
    }
    public function medication_csv() 
    {
        return Excel::download(new MedicationExport, 'medications.csv');
    }

    public function consultation_xlsx() 
    {
        return Excel::download(new ConsultationExport, 'consultations.xlsx');
    }
    public function consultation_csv() 
    {
        return Excel::download(new ConsultationExport, 'consultations.csv');
    }

    public function exam_xlsx() 
    {
        return Excel::download(new ExamExport, 'exams.xlsx');
    }
    public function exam_csv() 
    {
        return Excel::download(new ExamExport, 'exams.csv');
    }

    public function prescribe_xlsx() 
    {
        return Excel::download(new PrescribeExport, 'prescribes.xlsx');
    }
    public function prescribe_csv() 
    {
        return Excel::download(new PrescribeExport, 'prescribes.csv');
    }

    public function doctor_xlsx() 
    {
        return Excel::download(new DoctorExport, 'doctors.xlsx');
    }
    public function doctor_csv() 
    {
        return Excel::download(new DoctorExport, 'doctors.csv');
    }

    public function department_xlsx() 
    {
        return Excel::download(new DepartmentExport, 'departments.xlsx');
    }
    public function department_csv() 
    {
        return Excel::download(new DepartmentExport, 'departments.csv');
    }

    public function comment_xlsx() 
    {
        return Excel::download(new CommentExport, 'comments.xlsx');
    }
    public function comment_csv() 
    {
        return Excel::download(new CommentExport, 'comments.csv');
    }
}
