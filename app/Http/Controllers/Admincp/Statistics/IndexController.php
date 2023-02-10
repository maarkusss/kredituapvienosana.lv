<?php

namespace App\Http\Controllers\Admincp\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Admincp\Commissions;
use App\Models\Admincp\Lenders\Lenders;
use App\Models\Clicks;
use App\Models\Visitors\Visitors;

class IndexController extends Controller
{
    /**
     * Show the lenders index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admincp.statistics.index')->with([
            'chart_data' => $this->getChartData(),
            'lenders' => $this->getLenders(),
        ]);
    }

    public function getChartData()
    {
        $datePicker = explode(' to ', request()->datePicker);

        if (count($datePicker) == 1) {
            $datePicker[1] = $datePicker[0];
        }

        if (request()->datePicker) {
            $from = $datePicker[0];
            $to = $datePicker[1];
        } else {
            $from = date('Y-m-d', strtotime('-30 days'));
            $to = date('Y-m-d');
        }

        for ($i = strtotime($from); $i <= strtotime($to); $i = $i + 86400) {
            $chart['visitors'][date('Y-m-d', $i)] =
                Visitors::where('created_at', '>=', date('Y-m-d 00:00:00', $i))
                    ->where('created_at', '<=', date('Y-m-d 23:59:59', $i))
                    ->count();

            $chart['clicks'][date('Y-m-d', $i)] =
                Clicks::where('created_at', '>=', date('Y-m-d 00:00:00', $i))
                    ->where('created_at', '<=', date('Y-m-d 23:59:59', $i))
                    ->count();

            $chart['commissions'][date('Y-m-d', $i)] =
                Commissions::where('commission_date', '>=', date('Y-m-d 00:00:00', $i))
                    ->where('created_at', '<=', date('Y-m-d 23:59:59', $i))
                    ->sum('commission');
        }

        return $chart;
    }

    public function getLenders()
    {
        $datePicker = explode(' to ', request()->datePicker);
        $array = [];

        if (count($datePicker) == 1) {
            $datePicker[1] = $datePicker[0];
        }

        if (request()->datePicker) {
            foreach (Lenders::orderBy('name')->get() as $lender) {
                $clicks = Clicks::where('lender_id', $lender->id)->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime($datePicker[0])))->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($datePicker[1])))->count();
                $commissions = Commissions::where('lender_id', $lender->id)->where('status', 'A')->where('commission_date', '>=', date('Y-m-d 00:00:00', strtotime($datePicker[0])))->where('commission_date', '<=', date('Y-m-d 23:59:59', strtotime($datePicker[1])))->sum('commission');
                $epc = $clicks == 0 ? 0 : $commissions / $clicks;

                $array[$lender->id]['name'] = $lender->name;
                $array[$lender->id]['confirmed'] = $lender->commissions->where('status', 'A')->where('commission_date', '>=', date('Y-m-d 00:00:00', strtotime($datePicker[0])))->where('commission_date', '<=', date('Y-m-d 23:59:59', strtotime($datePicker[1])))->where('commission', '>', 0)->sum('commission');
                $array[$lender->id]['waiting'] = $lender->commissions->where('status', 'P')->where('commission_date', '>=', date('Y-m-d 00:00:00', strtotime($datePicker[0])))->where('commission_date', '<=', date('Y-m-d 23:59:59', strtotime($datePicker[1])))->where('commission', '>', 0)->sum('commission');
                $array[$lender->id]['clicks'] = $clicks;
                $array[$lender->id]['commssions'] = $commissions;
                $array[$lender->id]['epc'] = $epc;

                if ($epc == 0) {
                    $style = 'color:grey';
                } elseif ($epc < 0.15) {
                    $style = 'color:red;font-weight:bold;';
                } elseif ($epc < 0.25) {
                    $style = 'color:red;';
                } elseif ($epc < 0.35) {
                    $style = 'color:orange;';
                } elseif ($epc < 0.5) {
                    $style = 'color:green;';
                } else {
                    $style = 'color:green;font-weight:bold;';
                }

                $array[$lender->id]['style'] = $style;
            }
        } else {
            foreach (Lenders::orderBy('name')->get() as $lender) {
                $clicks = Clicks::where('lender_id', $lender->id)->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime('-30 days')))->where('created_at', '<=', date('Y-m-d 23:59:59'))->count();
                $commissions = Commissions::where('lender_id', $lender->id)->where('status', 'A')->where('commission_date', '>=', date('Y-m-d 00:00:00', strtotime('-30 days')))->where('commission_date', '<=', date('Y-m-d 23:59:59'))->sum('commission');
                $epc = $clicks == 0 ? 0 : $commissions / $clicks;

                $array[$lender->id]['name'] = $lender->name;
                $array[$lender->id]['confirmed'] = $lender->commissions->where('status', 'A')->where('commission_date', '>=', date('Y-m-d 00:00:00', strtotime('-30 days')))->where('commission_date', '<=', date('Y-m-d 23:59:59'))->where('commission', '>', 0)->sum('commission');
                $array[$lender->id]['waiting'] = $lender->commissions->where('status', 'P')->where('commission_date', '>=', date('Y-m-d 00:00:00', strtotime('-30 days')))->where('commission_date', '<=', date('Y-m-d 23:59:59'))->where('commission', '>', 0)->sum('commission');
                $array[$lender->id]['clicks'] = $clicks;
                $array[$lender->id]['commssions'] = $commissions;
                $array[$lender->id]['epc'] = $epc;

                if ($epc == 0) {
                    $style = 'color:grey';
                } elseif ($epc < 0.15) {
                    $style = 'color:red;font-weight:bold;';
                } elseif ($epc < 0.25) {
                    $style = 'color:red;';
                } elseif ($epc < 0.35) {
                    $style = 'color:orange;';
                } elseif ($epc < 0.5) {
                    $style = 'color:green;';
                } else {
                    $style = 'color:green;font-weight:bold;';
                }

                $array[$lender->id]['style'] = $style;
            }
        }

        return $array;
    }
}
