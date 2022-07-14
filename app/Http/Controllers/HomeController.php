<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountHolder;
use App\Transaction;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //>with('success',Request::ip())


    public function manageclients(Request $request)
    {
        $accountholders = AccountHolder::orderBy('id','ASC')->paginate(15);
       return view('clients',compact('accountholders'))
           ->with('i', ($request->input('page', 1) - 1) * 15);

    }

    public function viewtrans(Request $request,$id)
    {

$january=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-01-01', '2022-01-31'])->sum('amount');
$february=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-02-01', '2022-02-29'])->sum('amount');
$march=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-03-01', '2022-03-31'])->sum('amount');
$april=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-04-01', '2022-04-30'])->sum('amount');
$may=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-05-01', '2022-05-31'])->sum('amount');
$june=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-06-01', '2022-06-30'])->sum('amount');
$july=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-07-01', '2022-07-31'])->sum('amount');
$august=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-08-01', '2022-08-31'])->sum('amount');
$september=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-09-01', '2022-09-30'])->sum('amount');
$october=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-10-01', '2022-10-31'])->sum('amount');
$november=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-11-01', '2022-11-30'])->sum('amount');
$december=Transaction::where('account_number',$id)->whereBetween('transaction_date', ['2022-12-01', '2022-012-31'])->sum('amount');

        $accountholders = Transaction::orderBy('id','ASC')->where('account_number',$id)->paginate(15);
       return view('viewtrans',compact('accountholders',
       'january','february','march','april','may','june','july','august','september','october','november','december'))
           ->with('i', ($request->input('page', 1) - 1) * 15);

    }


public function activate(Request $request,$id){

$getaccount=AccountHolder::where('account_number',$id)->get();
//dd($getaccount);
$id=$getaccount[0]->id;
$user = AccountHolder::find($id);
$user->update(['status'=>'Active']);

return back()->with('status', 'successfully activated an account.');

}



public function changepassword()
{
    return view('changepassword');
}

public function passchange(Request $request){
    $this->validate($request, [
        'oldpassword' => ['required', 'string', 'min:8'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
$oldepassword=$request->input('oldpassword');
$password=$request->input('password');

$loggedin=Auth::id();
$user=User::find($loggedin);
$pass=$user->password;
if(password_verify($oldepassword, $pass)) {
    $user->update(['password'=>Hash::make($password)]);
    return back()->with('status', 'successfully changed password for your account.');
}
else
{
    return back()->with('oldpassword', 'wrong old password.');
}


}



}
