<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admincp\Consumers\Consumers;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\App;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    public function redirectTo()
    {
        $user = Consumers::find(request()->route('id'));

        return App::getLocale() . '/offer?utm_source=' . $user->utm_source . '&utm_medium=' . $user->utm_medium . '&utm_campaign=' . $user->utm_campaign . '&utm_content=' . $user->utm_content . '&gclid=' . $user->gclid;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify()
    {
        $user = Consumers::find(request()->route('id'));

        if (!hash_equals((string) request()->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException();
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));

            if ($user->utm_source == 'goodaff' && env('GOODAFF_CAMPAIGN_ID')) {
                $client = new \GuzzleHttp\Client();
                $client->request('GET', 'https://postback.goodaff.com', ['query' => [
                    'campaign_id' => env('GOODAFF_CAMPAIGN_ID'),
                    'transaction_id' => $user->id,
                    'click_id' => $user->utm_content,
                    'type' => 'cpl',
                    'status' => 'A',
                ]]);
            }
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}
