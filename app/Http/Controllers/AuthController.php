<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgetMail;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\UserVerify;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        try {
            if (Auth::attempt($request->only("email", "password"))) {
                /** @var \App\Models\MyUserModel $user **/
                $user = Auth::user();
                $token = $user->createToken("app")->accessToken;

                return response([
                    "message" => "Login successfully",
                    "user" => $user,
                    "token" => $token,
                ]);
            }
        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ]);
        }

        return response([
            "message" => "Invalid email or password",
        ], 401);
    }

    public function Register(RegisterRequest $request)
    {
        try {

            // save the photo profile in the folder
            $photo = $request->file('photo')->getClientOriginalExtension();
            $photo_name = time() . "." . $photo;
            $path = "storage/photos/users";
            $request->photo->move($path, $photo_name);

            $user = User::create([
                "name" => $request->name,
                "profile_photo_path" => $photo_name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "phone_number" => $request->phone_number,
                "phone_country" => $request->phone_country,
            ]);

            $token = $user->createToken("app")->accessToken;

            Mail::to($request->email)->send(new VerifyMail($token));

            $thisUser = User::where("email", $request->email)->first();

            UserVerify::create([
                "user_id" => $thisUser->id,
                "token" => $token,
            ]);

            return response([
                "message" => "Account Created Successfully",
                "token" => $token,
                "user" => $user,
            ]);
        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function Forget(MailRequest $request)
    {
        $email = $request->email;
        try {
            if (User::where("email", $email)->doesntExist()) {
                return response([
                    "message" => "The Email Is Invalid",
                ], 401);
            }

            // generate rand token
            $token = rand(10000, 9999999);

            try {
                DB::table("password_resets")->insert([
                    "email" => $email,
                    "token" => $token,
                ]);

                Mail::to($email)->send(new ForgetMail($token));

                return response([
                    "message" => "Reset password mail send on your email",
                ]);

            } catch (Exception $e) {
                return response([
                    "message" => $e->getMessage(),
                ]);
            }

        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function Reset(Request $request)
    {
        try {
            $email = $request->email;
            $token = $request->token;
            $password = Hash::make($request->password);

            $emailCheck = DB::table("password_resets")->where("email", $email)->first();
            $tokenCheck = DB::table("password_resets")->where("token", $token)->first();

            if (!$emailCheck) {
                return response([
                    "message" => "Email Is NOT Found",
                ], 401);
            } else if (!$tokenCheck) {
                return response([
                    "message" => "Pin Code Is Invalid",
                ], 401);
            }

            User::where("email", $email)->update(["password" => $password]);
            DB::table("password_resets")->where("email", $email)->delete();

            return response([
                "message" => "Password changed successfully",
            ]);

        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function UserData()
    {
        return Auth::user();
    }

    public function Logout(Request $request)
    {
        try {
            Auth::logout();

            return response([
                "message" => "You are logged out successfully",
            ]);
        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
        return response([
            "message" => $message,
        ]);
    }

}
