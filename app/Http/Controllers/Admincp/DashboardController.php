<?php

namespace App\Http\Controllers\Admincp;

use App\Http\Controllers\Controller;
use App\Models\Admincp\Commissions;
use App\Models\Clicks;
use App\Models\Visitors\Visitors;

class DashboardController extends Controller
{
    /**
     * Show the admincp dashboard page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admincp.dashboard')->with([
            'data' => $this->getStatistics(),
            'chart_data' => $this->getChartData(),
        ]);
    }

    public function api()
    {
        return view('admincp.api');
    }

    public function getChartData()
    {
        for ($i = strtotime(date('Y-m-d', strtotime('-7days'))); $i <= strtotime(date('Y-m-d')); $i = $i + 86400) {
            $chart['clicks'][date('Y-m-d', $i)] = Clicks::whereDate('created_at', date('Y-m-d', $i))->count();
            $chart['visitors'][date('Y-m-d', $i)] = Visitors::whereDate('created_at', date('Y-m-d', $i))->count();
            $chart['commissions'][date('Y-m-d', $i)] = Commissions::whereDate('commission_date', date('Y-m-d', $i))->where('status', 'A')->sum('commission');
        }

        return $chart;
    }

    public function getStatistics()
    {
        $array['clicks']['today'] = Clicks::whereDate('created_at', now())->count();
        $array['clicks']['yesterday'] = Clicks::whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->count();

        $array['visitors']['today'] = Visitors::whereDate('created_at', now())->count();
        $array['visitors']['yesterday'] = Visitors::whereDate('created_at', date('Y-m-d', strtotime('-1 day')))->count();

        $array['commissions']['today'] = Commissions::whereDate('commission_date', date('Y-m-d'))->where('status', 'A')->sum('commission');
        $array['commissions']['yesterday'] = Commissions::whereDate('commission_date', date('Y-m-d', strtotime('-1 day')))->where('status', 'A')->sum('commission');

        if ($array['clicks']['yesterday'] == 0) {
            $array['clicks']['percentage'] = number_format(($array['clicks']['today'] - $array['clicks']['yesterday']) * 100, 2);
        } else {
            $array['clicks']['percentage'] = number_format(($array['clicks']['today'] - $array['clicks']['yesterday']) / $array['clicks']['yesterday'] * 100, 2);
        }

        if ($array['commissions']['yesterday'] == 0) {
            $array['commissions']['percentage'] = number_format(($array['commissions']['today'] - $array['commissions']['yesterday']) * 100, 2);
        } else {
            $array['commissions']['percentage'] = number_format(($array['commissions']['today'] - $array['commissions']['yesterday']) / $array['commissions']['yesterday'] * 100, 2);
        }

        if ($array['visitors']['yesterday'] == 0) {
            $array['visitors']['percentage'] = number_format(($array['visitors']['today'] - $array['visitors']['yesterday']) * 100, 2);
        } else {
            $array['visitors']['percentage'] = number_format(($array['visitors']['today'] - $array['visitors']['yesterday']) / $array['visitors']['yesterday'] * 100, 2);
        }

        if ($array['visitors']['today'] < $array['visitors']['yesterday']) {
            $array['visitors']['color'] = 'text-red-500';
        } elseif ($array['visitors']['today'] == $array['visitors']['yesterday']) {
            $array['visitors']['color'] = 'text-gray-500';
        } else {
            $array['visitors']['color'] = 'text-green-500';
        }

        if ($array['clicks']['today'] < $array['clicks']['yesterday']) {
            $array['clicks']['color'] = 'text-red-500';
        } elseif ($array['clicks']['today'] == $array['clicks']['yesterday']) {
            $array['clicks']['color'] = 'text-gray-500';
        } else {
            $array['clicks']['color'] = 'text-green-500';
        }

        if ($array['commissions']['today'] < $array['commissions']['yesterday']) {
            $array['commissions']['color'] = 'text-red-500';
        } elseif ($array['commissions']['today'] == $array['commissions']['yesterday']) {
            $array['commissions']['color'] = 'text-gray-500';
        } else {
            $array['commissions']['color'] = 'text-green-500';
        }

        return $array;
    }
}
