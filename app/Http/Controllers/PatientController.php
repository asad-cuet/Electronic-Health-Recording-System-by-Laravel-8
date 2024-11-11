<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\ClinicalHistory;
use App\Models\consultation;
use App\Models\Exam;
use App\Models\Medication;
use Illuminate\Support\Collection;
use Log;

class PatientController extends Controller
{
    public function patients()
    {
        $patients=Patient::orderBy('id','desc')->paginate(50);

        return view('pages.patient.patient_list',['patients'=>$patients]);

    }
    public function patient_form()
    {
        return view('pages.patient.patient_form');
    }
    public function add_patient(Request $request)
    {
        $history_id=uniqid();

      
        if(Patient::where('history_id',$history_id)->exists())
        {
            $history_id.=$request->input('age');
        }
        if(Patient::where('history_id',$history_id)->exists())
        {
            $history_id=time().$request->input('age');
        }
        $full_name=$request->input('pre_name').' '.$request->input('fname').' '.$request->input('lname');
       $data=[
        'pre_name'=>$request->input('pre_name'),
        'fname'=>$request->input('fname'),
        'lname'=>$request->input('lname'),
        'full_name'=>$full_name,
        'gender'=>$request->input('gender'),
        'age'=>$request->input('age'),
        'height'=>$request->input('height'),
        'weight'=>$request->input('weight'),
        'address'=>$request->input('address'),
        'phone'=>$request->input('phone'),
        'health_insurance'=>$request->input('health_insurance'),
        'guardian_name'=>$request->input('guardian_name'),
        'guardian_phone'=>$request->input('guardian_phone'),
        'relationship'=>$request->input('relationship'),
        'history_id'=>$history_id
       ];
        Patient::create($data);      

        $this->sendSSLSMS($request->input('phone'), "Welcome ".$request->input('pre_name')." ".$request->input('fname').". You can see your details here:".route('patient_status',$history_id));

        return redirect(route('patients'))->with('status','Patient Added Successfully');
    }
    
    public function patient_view($id)
    {
        $patient=Patient::where('id',$id)->first();
        return view('pages.patient.patient_view',['patient'=>$patient]);

    }

    public function patient_update(Request $request,$id)
    {

       if(Patient::where('id',$id)->where('is_cleared',1)->exists())
       {
        return back()->with('danger',"For this patient this action is no longer available.");
       }
        
       $data=[
        'pre_name'=>$request->input('pre_name'),
        'fname'=>$request->input('fname'),
        'lname'=>$request->input('lname'),
        'gender'=>$request->input('gender'),
        'age'=>$request->input('age'),
        'height'=>$request->input('height'),
        'weight'=>$request->input('weight'),
        'address'=>$request->input('address'),
        'phone'=>$request->input('phone'),
        'health_insurance'=>$request->input('health_insurance'),
        'guardian_name'=>$request->input('guardian_name'),
        'guardian_phone'=>$request->input('guardian_phone'),
        'relationship'=>$request->input('relationship')
       ];

        Patient::where('id',$id)->update($data);                    
        return redirect(route('patients'))->with('status','Patient Updated Successfully');
    }
    public function consultant($id)
    {
           $doctors=Doctor::all();
           $doctors=collect($doctors)->map(function($item,$key)
           {
            return [
                'doctor_id'=>$item['id'],
                'name'=>$item->user->name,
                'department'=>$item->department->name
                 ];
            });
            return view('pages.consultation.consultation_room',['doctors'=>$doctors,'patient_id'=>$id]);

    }

    public function consultant_to(Request $request,$patient_id)
    {
        if($request->input('doctor_id')==0)
        {
            return back()->with('danger',"Can't submit empty");
        }
        $doctor_department_id=Doctor::where('id',$request->input('doctor_id'))->first()->department_id;
        $data=[
          'patient_id'=>$patient_id,
          'consulted_by'=>$request->input('doctor_id'),
          'department_id'=>$doctor_department_id
        ];
        $update_data=[
            'is_consulted'=>1
        ];
        Patient::where('id',$patient_id)->update($update_data);
        consultation::create($data);
        ClinicalHistory::create(['patient_id'=>$patient_id]);
        Medication::create(['patient_id'=>$patient_id]);
        return redirect(route('patients'))->with('status','Patient sent to Consultation');


    }

    public function patient_status($history_id)
    {


        if(!Patient::where('history_id',$history_id)->exists())
        {
            return "The ID doesn't exist";
        }
        $patient=Patient::where('history_id',$history_id)->first();


        if(!consultation::where('patient_id',$patient->id)->exists())
        {
            return "This Patient not consulted yet";
        }
        $consultation=consultation::where('patient_id',$patient->id)->first();



        $test=Exam::where('consultation_id',$consultation->id)->get();
        $history=ClinicalHistory::where('patient_id',$consultation->patient_id)->first();
        $medication=Medication::where('patient_id',$consultation->patient_id)->first();
        $object=[
            'consultation'=>$consultation,
            'test'=>$test,
            'history'=>$history,
            'medication'=>$medication
        ];
        return view('pages.patient.patient_status',$object);
    }


    function singleSms($msisdn, $messageBody, $csmsId)
    {
        // $msisdn -> phone
        // $messageBody -> message
        // $csmsId -> an unique id

        $params = [
            "api_token" => env('SSL_SMS_API_TOKEN'),
            "sid" => env('SSL_SMS_SID'),
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];

        Log::channel('sms')->info("SMS Request phone: ".$msisdn);

        // https://smsplus.sslwireless.com/api/v3/send-sms
        $url = trim('https://smsplus.sslwireless.com', '/')."/api/v3/send-sms";
        $params = json_encode($params);

        return $this->callApi($url, $params);
    }


    function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        Log::channel('sms')->info("Sms Response: ".$response);

        return $response;
    }


    function sendSSLSMS($phone, $text)
    {

        if(gettype($phone)!='string')
        {
            $phone = (string) $phone;
        }
        $msisdn=$phone;
        $messageBody=$text;
        $csmsId=uniqid();

        // return 1;
        $data=json_decode($this->singleSms($msisdn, $messageBody, $csmsId));

        return $data;


        //Response Demo: {"status":"SUCCESS","status_code":200,"error_message":"","smsinfo":[{"sms_status":"SUCCESS","status_message":"Success","msisdn":"8801781856861","sms_type":"EN","sms_body":"This is a test message","csms_id":"644f9ad337562","reference_id":"644f9ad37a867181381"}]}

    }

    function sendApiSMS(Request $request)
    {
        Log::channel('sms')->info("Sms request: ".json_encode($request->all()));
        if($request->api_key==12345 || $request->api_key=='12345')
        {
            return $this->sendSSLSMS($request->phone,$request->message);
        }
    }


    // function sendApiSMS(Request $request)
    // {
    //     Log::channel('sms')->info("Sms content: ".$request->getContent());
    //     Log::channel('sms')->info("Sms content type: ".gettype($request->getContent()));
    //     Log::channel('sms')->info("Sms request: ".json_encode($request->all()));

    //     $body=json_decode($request->getContent(),1);
    //     // Log::channel('sms')->info("body type: ".gettype($body));

    //     if($body['api_key']==12345 || $body['api_key']=='12345')
    //     {
    //         return $this->sendSSLSMS($body['phone'],$body['message']);
    //     }
    // }
}
