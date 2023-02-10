<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function sendMail(Request $request)
    {
        if ($request->recaptcha) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                'secret=6LeX0AohAAAAANCALcR4A0nkqwbCOJvg1UUwxYPJ&remoteip=' . $_SERVER['REMOTE_ADDR'] . '&response=' . $request->recaptcha
            );

            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close($ch);

            $recaptcha = json_decode($server_output);

            if ($recaptcha->score >= 0.1) {
                $to = 'info@' . $request->getHost();
                $subject = 'Contact Form from website';
                $message = $request->message;
                $headers = 'From: ' . $request->email . "\r\n" .
                    'Reply-To: ' . $request->email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
            }

            return redirect()->back()->with('success', __('Message sent successfully!'));
        } else {
            return redirect()->back()->with('error', __('Message failed to send!'));
        }
    }
}
