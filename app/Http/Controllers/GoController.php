<?php

namespace App\Http\Controllers;

use App\Models\Admincp\Lenders\Lenders;
use App\Models\Admincp\Settings;
use App\Models\Clicks;
use App\Models\Visitors\Visitors;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GoController extends Controller
{
    /**
     * Return go view.
     *
     * @param Request $request
     * @param string $lender_id
     * @param string $position
     * @return View
     */
    public function index(Request $request, string $lender_id, string $position)
    {
        $lender = Lenders::where('id', $lender_id)->firstOrFail();
        $visitor = Visitors::where('id', $request->cookie('visitor_id'))->first();

        // $curl = curl_init();

        // $optArray = [
        //     CURLOPT_URL => 'https://www.goodaff.com/api/geoip.php?ip=' . $request->ip(),
        //     CURLOPT_RETURNTRANSFER => true,
        // ];

        // curl_setopt_array($curl, $optArray);
        // $result = curl_exec($curl);
        // $result = json_decode($result);

        // if ($result) {
        //     $countryCode = $result->countryCode;
        // } else {
        //     $countryCode = null;
        // }

        $utm_source = $request->cookie('utm_source');
        $utm_medium = $request->cookie('utm_medium');
        $utm_campaign = $request->cookie('utm_campaign');
        $utm_content = $request->cookie('utm_content');
        $gclid = $request->cookie('gclid');

        if ($request->utm_source) {
            $utm_source = $request->utm_source;
        }

        if ($request->utm_medium) {
            $utm_medium = $request->utm_medium;
        }

        if ($request->utm_campaign) {
            $utm_campaign = $request->utm_campaign;
        }

        if ($request->utm_content) {
            $utm_content = $request->utm_content;
        }

        if ($request->gclid) {
            $gclid = $request->gclid;
        }

        Clicks::create([
            'visitor_id' => $request->cookie('visitor_id'),
            'lender_id' => $lender_id,
            'referer' => $request->header('referer'),
            'utm_source' => $request->cookie('utm_source'),
            'utm_medium' => $request->cookie('utm_medium'),
            'utm_campaign' => $request->cookie('utm_campaign'),
            'utm_content' => $request->cookie('utm_content'),
            'gclid' => $request->cookie('gclid'),
            'ip' => $request->ip(),
            // 'country' => $countryCode,
            'user_agent' => $request->header('user-agent'),
        ]);

        if ($visitor) {
            $visitor->increment('clicks');
        }

        $lender->increment('clicks');
        $prefix = Settings::where('name', 'prefix')->first();

        if (strstr($lender->affiliate_link, 'goodaff.com')) {
            return view('go')->with([
                'link' => $lender->affiliate_link . '?s1=' . $prefix->value . '&s2=' . $utm_campaign . '&s3=' . $gclid . '&s4=' . $utm_content . '&s5=' . $utm_source . '&s6=' . $position,
            ]);
        } else {
            return view('go')->with([
                'link' => $lender->affiliate_link,
            ]);
        }
    }
}
