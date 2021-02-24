<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\otp_codes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Carbon\Carbon;
// use App\Mail\RegisterMail;
// use Illuminate\Support\Facades\Mail;
use App\Events\EventForRegister;




class RegisterController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);

        $NewUser = new User();
        // $NewUser->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $NewUser->name = $request['name'];
        $NewUser->email = $request['email'];
        $NewUser->password = Hash::make($request['password']);
        $NewUser->save();

            // dd($NewUser);
        
        $GetEmail = $NewUser->email;//unused digunakan buat kirim email nanti
        $GetId = $NewUser->id;
        // $GetName = $NewUser->name;
        $Name= $NewUser->name;


         //get initial for otpcode
        //  $GetChar=Str::substr($GetName, 0, 4);
        //  $GetUpperChar=strtoupper($GetChar);
         //
         //get rand 6 number
         $GetSixRandomNumber = mt_rand(100000,999999);
         // name + 6 rand number
        $GetOtpCode=$GetSixRandomNumber;
        //
         //get otp valid time
         $Valid_time= Carbon::now()->addMinute(5);
         //
        $NewOtp = new otp_codes();
        $NewOtp->otp = $GetOtpCode;
        $NewOtp->user_id = $GetId;
        $NewOtp->valid_until=$Valid_time;
        $NewOtp->save();

        $OtpCode=$NewUser->otp;
        $ExpTime=$NewOtp->valid_until;

        // Mail::to($GetEmail)->send(new RegisterMail($Name,$OtpCode,$ExpTime));
        event(new EventForRegister($Name,$OtpCode,$ExpTime,$GetEmail));


        return 'Succes Make Account';
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
