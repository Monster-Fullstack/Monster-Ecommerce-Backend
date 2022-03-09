<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function CreateMessage(Request $request)
    {
        $name = $request->input("name");
        $email = $request->input("email");
        $message = $request->input("message");
        // for time
        date_default_timezone_set("Africa/Cairo");
        $contact_date = date("d-m-y");
        $contact_time = date("h:i:sa");
        // post it \ create it
        $result = Contact::insert([
            "name" => $name,
            "email" => $email,
            "message" => $message,
            "contact_date" => $contact_date,
            "contact_time" => $contact_time,
        ]);

        return $result;
    }
}
