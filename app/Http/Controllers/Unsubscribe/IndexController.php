<?php

namespace App\Http\Controllers\Unsubscribe;

use App\Http\Controllers\Controller;
use App\Models\Admincp\Consumers\Consumers;
use App\Models\Admincp\Settings;

class IndexController extends Controller
{
    public function unsubscribe()
    {
        return view('unsubscribe');
    }

    public function postUnsubscribe()
    {
        $consumers = Consumers::where('phone', request()->phone)->get();

        if (count($consumers) > 0) {
            $consumer = $consumers->first();

            if ($consumer->subscribed == 1) {
                $client = new \GuzzleHttp\Client();

                $client->request('PUT', 'https://hoi.fm/api/sms/' . Settings::where('name', 'country_code')->first()->value . $consumer->phone, ['query' => [
                    'active' => 0,
                ], 'headers' => [
                    'usertoken' => env('HOI_USER_TOKEN'),
                    'projecttoken' => env('HOI_SMS_PROJECT_TOKEN'),
                ]]);

                $client->request('PUT', 'https://hoi.fm/api/mail/' . $consumer->email, ['query' => [
                    'active' => 0,
                ], 'headers' => [
                    'usertoken' => env('HOI_USER_TOKEN'),
                    'projecttoken' => env('HOI_EMAIL_PROJECT_TOKEN'),
                ]]);

                $consumer->update([
                    'subscribed' => 0,
                ]);

                return redirect()->back()->with([
                    'success' => __('main.Успешно отписаны.'),
                ]);
            } else {
                return redirect()->back()->with([
                    'error' => __('main.Не удалось отписаться.'),
                ]);
            }
        } else {
            return redirect()->back()->with([
                'error' => __('main.Не удалось отписаться.'),
            ]);
        }
    }
}
