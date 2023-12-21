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
            Mail::raw(
                "Name: $name\nEmail: $email\nSubject: $subject\nMessage Content:\n$messageContent",
                function ($message) use ($subject) {
                    $message->to('bryansamuelangka@gmail.com')->subject($subject);
                }
            );


            // Return view after sending email with the status

            return view('contact', ['status' => true, 'pagetitle' => 'Contact']);

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Failed to send email: ' . $e->getMessage());

            // Return an error view
            $status = "failed";
            return view('contact', ['status' => false, 'pagetitle' => 'Contact']);
        }
    }
}
