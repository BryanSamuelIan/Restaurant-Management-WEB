<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $messageContent = $request->input('message');
        $subject = $request->input('subject');

        try {
            // Sending email using Laravel Mail class
            Mail::raw("Name: $name\nEmail: $email\nMessage: $messageContent", function ($message) use ($subject) {
                $message->to('bryansamuelangka@gmail.com')->subject("New Feedback: $subject");
            });

            $status = "sent";

            // Returning view after sending email with the status
            return view('contact', ['status' => $status, 'pagetitle' => 'Contact']);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
