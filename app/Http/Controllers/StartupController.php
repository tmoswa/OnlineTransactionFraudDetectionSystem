<?php

namespace App\Http\Controllers;

use App\Mail\OTPMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\AccountHolder;
use App\ExistingAccount;
use App\OTP;
use App\AccountType;
use App\Transaction;
use Carbon\Carbon;

class StartupController extends Controller
{
    //
    public function index()
    {
        return view('auth/login');
    }

    public function first_reg()
    {
        return view('auth/first_reg');
    }
    public function finregistry()
    {
        return view('auth/success');
    }
    public function transact_online()
    {
        return view('auth/transact_online');
    }

    public function register_first(Request $request){
        $this->validate($request, [
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'account_number' => 'required|min:16|max:16',
            'national_id' => 'required|min:10|max:16',
            'pin_code' => 'required|min:4|max:4',
        ]);
$getaccount=ExistingAccount::where('acc_number',$request->input('account_number'))
->where('national_id',$request->input('national_id'))->get();
if($getaccount->isEmpty())
{
    return back()->with('nodata', 'There is no such information in our systems, kinldy visit nearest CBZ branch and verify your account details.');

}
else
{
    $firstname=$request->input('first_name');
    $lastname=$request->input('last_name');
    $account_number=$request->input('account_number');
    $national_id=$request->input('national_id');
    $pin_code=$request->input('pin_code');
    $phone=$getaccount[0]->phone_number;
    $mail=$getaccount[0]->email;

$digits=4;
$num=rand(pow(10, $digits-1), pow(10, $digits)-1);



    $maildata = [
        'OTP_data' => $num
    ];
    //
    Mail::to($mail)->send(new OTPMailNotification($maildata));


OTP::where('account_number',$account_number)->delete();
OTP::create(['account_number'=>$account_number,'otp'=>$num]);
return view('auth/verify_details',compact('firstname','lastname','account_number','national_id','pin_code','phone','mail'));

}

    }

    public function register_otp(Request $request)
    {
         $this->validate($request, [
            'otp' => ['required', 'min:4|max:4'],
        ]);

    $firstname=$request->input('first_name');
    $lastname=$request->input('last_name');
    $account_number=$request->input('account_number');
    $national_id=$request->input('national_id');
    $pin_code=$request->input('pin_code');
    $otp=$request->input('otp');
    $phone=$request->input('phone');

     $otp_entered  = OTP::where('account_number',$account_number)->get();

     $accounttypes = AccountType::where('name','!=','Client Admin')->pluck('name','name');

     if($otp_entered[0]->otp==$otp)
     {
        return view('auth/finreg',compact('firstname','lastname','account_number','national_id','pin_code','otp','accounttypes','phone'));
     }

     else
     {
        return redirect()->route('account_register')
        ->with('nodata','Wrong OTP you cant proceed, OTP sent to you phone number is incorrect to the one entered');
     }

    }




    public function register_final(Request $request)
    {
         $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255','unique:account_holders'],
            'latitude' => ['required', 'min:4'],
            'longitude' => ['required', 'min:4'],
            'country' => ['required', 'min:4'],
            'account_type' => ['required', 'min:2'],
            'spending_category' => ['required', 'min:2'],
        ]);
       //dd("success");
    $firstname=$request->input('first_name');
    $lastname=$request->input('last_name');
    $account_number=$request->input('account_number');
    $national_id=$request->input('national_id');
    $pin_code=$request->input('pin_code');
    $otp=$request->input('otp');
    $phone=$request->input('phone');
    $email=$request->input('email');
    $latitude=$request->input('latitude');
    $longitude=$request->input('longitude');
    $country=$request->input('country');
    $account_type=$request->input('account_type');
    $spending_category=$request->input('spending_category');
    $input=$request->all();
    $getaccount=AccountHolder::where('account_number',$account_number)->where('national_id',$national_id)->get();
if($getaccount->isEmpty())
{
    AccountHolder::create($input);
}
else
{
    $id=$getaccount[0]->id;
    $user = AccountHolder::find($id);
    $user->update($input);
}

        return view('auth/success')
        ->with('success','Successfully secured account!!');


    }



    public function first_trans(Request $request)
    {
         $this->validate($request, [
            'account_number' => ['required', 'min:4'],
            'amount' => ['required', 'min:1'],
            'pin_code' => ['required', 'min:4'],
            'latitude' => ['required', 'min:2'],
            'longitude' => ['required', 'min:2'],
            'description' => ['required', 'min:5'],
        ]);
      //dd("firsttarns");

    $account_number=$request->input('account_number');
    $amount=$request->input('amount');
    $pin_code=$request->input('pin_code');
    $latitude=$request->input('latitude');
    $longitude=$request->input('longitude');
    $description=$request->input('description');

    $getaccount=AccountHolder::where('account_number',$account_number)->where('status','Active')->get();
if($getaccount->isEmpty())
{
    return back()->with('invaliddata', 'Invalid details verify your data before proceeding, or check with the nearest branch to see if your account is not blocked.');
}
else
{
    $pin=$getaccount[0]->pin_code;
    $id=$getaccount[0]->id;
    $secret=$getaccount[0]->secret;
    $saved_longitude=$getaccount[0]->longitude;
    $saved_latitude=$getaccount[0]->latitude;

    $account_type=$getaccount[0]->account_type;
    $spending_category=$getaccount[0]->spending_category;

    $phone=$getaccount[0]->phone_number;


    $user = AccountHolder::find($id);

    if($pin!=$pin_code)
    {

        if($secret==null || $secret=='0')
        {
            $user->update(['secret'=>'1']);
        }
        if($secret=='1')
        {
            $user->update(['secret'=>'2']);
        }
        else if($secret=='2')
        {
            $user->update(['status'=>'Blocked']);
        }
        return back()->with('invaliddata', 'Invalid pin code, verify your data before proceeding,3 fails and you are blocked.');
    }

    else{
        $user->update(['secret'=>'0']);

$latitudebal=$saved_latitude-$latitude;
$longitudebal=$saved_longitude-$longitude;


if( ($latitudebal>-2 && $latitudebal<2 ) && ($longitudebal>-2 && $longitudebal<2))
{
        $expectedminamount=0;
        $expectedmaxamount=0;
        if($spending_category=="first")
        {
            $expectedminamount=0;
            $expectedamount=500;
        }
        else if($spending_category=="second")
        {
            $expectedminamount=501;
            $expectedamount=2000;
        }
        else if($spending_category=="third")
        {
            $expectedminamount=2001;
            $expectedamount=5000;
        }
        else if($spending_category=="fourth")
        {
            $expectedminamount=5001;
            $expectedamount=20000;
        }
        else if($spending_category=="fifthy")
        {
            $expectedminamount=20001;
            $expectedamount=100000;
        }
       else{
        $expectedminamount=100001;
        $expectedamount=500001;
       }

       $digits=4;
       $digits1=6;
       $num=rand(pow(10, $digits-1), pow(10, $digits)-1);
       $num1=rand(pow(10, $digits1-1), pow(10, $digits1)-1);

       OTP::where('account_number',$account_number)->delete();


    $balance=$getaccount[0]->balance;

    $updated_balance=round($balance-$amount,2);

    if($updated_balance<0)
    {
        return back()->with('invaliddata', 'Amount Entered exceed your balance, You can Transact');

    }


       if($amount>$expectedamount)
       {
        $whole_message_message='Your cbz OTP: '.$num;

        $username = 'tmoswa';
       $token = 'eb25720dbbc2aeb6bb162a00b52d7853';
       $bulksms_ws = 'http://portal.bulksmsweb.com/index.php?app=ws';
       $destinations = $phone;
       $message = $whole_message_message;
       $ws_str = $bulksms_ws . '&u=' . $username . '&h=' . $token . '&op=pv';
       $ws_str .= '&to=' . urlencode($destinations) . '&msg='.urlencode($message);
       $ws_response = @file_get_contents($ws_str);


      $whole_message_email='Your cbz OTP: '.$num1;

      $to_name = $getaccount[0]->first_name.' '.$getaccount[0]->last_name;
      $to_email = $getaccount[0]->email;
      $data = array("name"=>$to_name, "body" => $whole_message_email);

      $mailer = app()['mailer'];
      $mailer->send("emails.mail", $data, function($message) use ($to_name, $to_email) {
      $message->to($to_email, $to_name)
      ->subject("Fraud detection System");
      $message->from("myproject22tim@gmail.com","Fraud detection System");
      });


       OTP::create(['account_number'=>$account_number,'otp'=>$num]);
       $user->update(['one_time_password'=>$num1]);
       $extra="Yes";
       }
else{
    $whole_message_message='Your cbz OTP: '.$num;

    $username = 'tmoswa';
   $token = 'eb25720dbbc2aeb6bb162a00b52d7853';
   $bulksms_ws = 'http://portal.bulksmsweb.com/index.php?app=ws';
   $destinations = $phone;
   $message = $whole_message_message;
   $ws_str = $bulksms_ws . '&u=' . $username . '&h=' . $token . '&op=pv';
   $ws_str .= '&to=' . urlencode($destinations) . '&msg='.urlencode($message);
   $ws_response = @file_get_contents($ws_str);

   OTP::create(['account_number'=>$account_number,'otp'=>$num]);
   $user->update(['one_time_password'=>'']);
   $extra="No";
}


return view('auth/verify_trans',compact('amount','account_number','latitude','longitude','description','num1','extra'));



}
else
{
    return back()->with('invaliddata', 'The location generating transaction is not authorised.');
}

    }


}

        return view('auth/success')
        ->with('success','Successfully secured account!!');


    }








    public function register_second_otp(Request $request)
    {
         $this->validate($request, [
            'otp' => ['required', 'min:4|max:4'],
        ]);

    $amount=$request->input('amount');
    $account_number=$request->input('account_number');
    $latitude=$request->input('latitude');
    $longitude=$request->input('longitude');
    $description=$request->input('description');
    $otp=$request->input('otp');
    $extra=$request->input('extra');

    $getaccount=AccountHolder::where('account_number',$account_number)->where('status','Active')->get();
    $balance=$getaccount[0]->balance;
    $id=$getaccount[0]->id;
    $updated_balance=round($balance-$amount,2);
    $user = AccountHolder::find($id);

    if($extra=='Yes')
    {
        $num1=$request->input('num1');

        $one_time_password=$getaccount[0]->one_time_password;

        $otp_entered  = OTP::where('account_number',$account_number)->get();

        if($num1!=$one_time_password || $otp!=$otp_entered[0]->otp)
        {


            $secret=$getaccount[0]->secret;



                if($secret==null || $secret=='0')
                {
                    $user->update(['secret'=>'1']);
                }
                if($secret=='1')
                {
                    $user->update(['secret'=>'2']);
                }
                else if($secret=='2')
                {
                    $user->update(['status'=>'Blocked']);
                }
                else
                {

                }
                return redirect()->route('transact_online')->with('invaliddata', 'email or sms verification invalid check your email or sms before proceeding,3 fails and you are blocked.');

        }


     else{
        $times='Africa/Harare';
        $date_now=Carbon::now($times)->format('Y-m-d');
        $time_now=Carbon::now($times)->format('H:i:s');

        Transaction::create([
             'account_number'=>$account_number,
             'otp'=>$otp,
             'longitude'=>$longitude,
             'latitude'=>$latitude,
             'description'=>$description,
             'amount'=>$amount,
             'transaction_date'=>$date_now,
             'transaction_time'=>$time_now,
             'status'=>"Processed",
             'ip_address'=>\Request::ip(),

             ]);
             $user->update(['balance'=>$updated_balance]);
             return redirect()->route('transact_online')->with('success', 'successfully processed transaction.');

     }
    }





    else
    {
        $num1=$request->input('num1');

        $getaccount=AccountHolder::where('account_number',$account_number)->where('status','Active')->get();

        $one_time_password=$getaccount[0]->one_time_password;

        $otp_entered  = OTP::where('account_number',$account_number)->get();

        if($otp!=$otp_entered[0]->otp)
        {

            $id=$getaccount[0]->id;
            $secret=$getaccount[0]->secret;

            $user = AccountHolder::find($id);

                if($secret==null || $secret=='0')
                {
                    $user->update(['secret'=>'1']);
                }
                if($secret=='1')
                {
                    $user->update(['secret'=>'2']);
                }
                else if($secret=='2')
                {
                    $user->update(['status'=>'Blocked']);
                }
                else
                {

                }
                return redirect()->route('transact_online')->with('invaliddata', 'email or sms verification invalid check your email or sms before proceeding,3 fails and you are blocked.');

        }


     else{
        $times='Africa/Harare';
        $date_now=Carbon::now($times)->format('Y-m-d');
        $time_now=Carbon::now($times)->format('H:i:s');
        $user->update(['balance'=>$updated_balance]);
        Transaction::create([
             'account_number'=>$account_number,
             'otp'=>$otp,
             'longitude'=>$longitude,
             'latitude'=>$latitude,
             'description'=>$description,
             'amount'=>$amount,
             'transaction_date'=>$date_now,
             'transaction_time'=>$time_now,
             'status'=>"Processed",
             'ip_address'=>\Request::ip(),

             ]);

             return redirect()->route('transact_online')->with('success', 'successfully processed transaction.');

     }
    }

    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }


}
