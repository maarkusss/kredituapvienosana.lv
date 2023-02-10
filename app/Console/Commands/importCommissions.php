<?php

namespace App\Console\Commands;

use App\Models\Admincp\Commissions;
use App\Models\Admincp\Lenders\Lenders;
use App\Models\Admincp\Settings;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class importCommissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commissions:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports commissions from Goodaff';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prefix = Settings::where('name', 'prefix')->first();

        $client = new Client();

        $response = $client->request('POST', 'https://www.goodaff.com/api', ['query' => [
            'user' => 2,
            'token' => '61ccf85eed1ffa77e20e25871de79ef8',
            'datefrom' => date('Y-m-d', strtotime('-7 days')),
            'dateto' => date('Y-m-d'),
            's1' => $prefix->value,
        ]]);

        $json = json_decode($response->getBody());

        if ($json) {
            $lenderid_arr = [
                "1" => "Bino - LV",
                "2" => "Moneza - LV",
                "3" => "Ferratum - LV",
                "4" => "Credit24 - LV",
                "6" => "Nordcard - LV",
                "7" => "Ladyloan - LV",
                "8" => "Crediton - LV",
                "9" => "Ondo - LV",
                "10" => "Vivus - LV",
                "11" => "Smscredit - LV",
                "12" => "Kimbi - LV",
                "15" => "Sohocredit - LV",
                "17" => "Sefinance - LV",
                "18" => "Banknote - LV",
                "19" => "Vizia - LV",
                "22" => "Mogo - LV",
                "30" => "Creamcredit - LV",
                "31" => "Creditus - LV",
                "246" => "Soscredit - LV",
                "254" => "Lkcentrs - LV",
                "270" => "Nordkredits - LV",
                "339" => "Viasms - LV",
                "352" => "Credify - LV",
                "696" => "Creditea - LV",
                "711" => "Latvijashipoteka - LV",
                "754" => "Altero - LV",
                "809" => "Ferratumprime - LV",
                "907" => "Latkredits - LV",
                "1028" => "Finea - LV",
                "1037" => "Dalidali - LV",
                "1083" => "Soso - LV",
            ];

            foreach ($json as $id => $data) {
                $commission = Commissions::where('uid', $data->id)->first();
                if ($data->campaign_id && array_key_exists($data->campaign_id, $lenderid_arr)) {
                    $explode_name = explode(' - ', $lenderid_arr[$data->campaign_id]);
                    if ($commission) {
                        if ($commission->status != $data->status) {
                            $commission->update([
                                'status' => $data->status,
                                'commission_date' => date('Y-m-d H:i:s'),
                            ]);
                        }
                    } else {
                        if (array_key_exists($data->campaign_id, $lenderid_arr) && $data->commission > 0) {
                            $lender = Lenders::where('name', 'like', $explode_name[0] . '%')->first();
                            if ($lender) {
                                Commissions::create([
                                    'visitor_id' => $data->visitor_id,
                                    'uid' => $data->id,
                                    'transaction_id' => $data->transaction_id,
                                    'commission' => $data->commission,
                                    'lender_id' => $lender->id,
                                    'referrer' => $data->click_referer,
                                    'ip' => $data->click_ip,
                                    'status' => $data->status,
                                    'utm_campaign' => $data->s2,
                                    'gclid' => $data->s3,
                                    'commission_date' => $data->created_date,
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
