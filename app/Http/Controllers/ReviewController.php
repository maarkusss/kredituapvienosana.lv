<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Reviews::get()->where('lang', app()->getLocale());

        return view('admincp.reviews.index')->with([
            'reviews' => $reviews,
        ]);
    }

    public function create(Request $request)
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

            if (isset($recaptcha->score)) {
                if ($recaptcha->score >= 0.1) {
                    $data = $request->validate([
                        'name' => 'required',
                        'rating' => 'required',
                        'text' => 'required',
                    ]);

                    $review = new Reviews();

                    $review->lender_id = $request->lenderID;
                    $review->name = $data['name'];
                    $review->rating = $data['rating'];
                    $review->text = $data['text'];
                    $review->lang = app()->getLocale();
                    $review->ip = request()->ip();

                    $review->save();

                    return redirect()->back()->with('success', __('Review has been submitted!'));
                } else {
                    return redirect()->back()->with('error', __('Oops, something went wrong!'));
                }
            } else {
                return redirect()->back()->with('error', __('Oops, something went wrong!'));
            }
        } else {
            return redirect()->back()->with('error', __('Oops, something went wrong!'));
        }
    }

    public function delete($id)
    {
        Reviews::where('id', $id)->delete();

        return redirect(route('admincp.reviews.index'))->with('success', 'Review has been deleted!');
    }
}
