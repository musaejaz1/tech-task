<?php

namespace App\Lib;

use GuzzleHttp\Client;

class HistoricalDataApi
{

    const api_key = '35067ecaa5msh6d1459e7749abd0p16a0f8jsn53c533dfc433';
    const api_baseuri = 'yh-finance.p.rapidapi.com';
    private $company_symbol;

    public function __construct($company_symbol)
    {
        $this->company_symbol = $company_symbol;
    }

    public function gethistoricaldata($start_date, $end_date)
    {

        //declaring headers
        $headers = [
            'Content-Type' => 'application/json',
            'X-RapidAPI-Key' => self::api_key,
            'X-RapidAPI-Host' => self::api_baseuri
        ];

        //HTTP request using Guzzle
        $client = new Client([
            'headers' => $headers
        ]);

        $response = $client->get('https://' . self::api_baseuri . '/stock/v3/get-historical-data?symbol=' . $this->company_symbol);

        $param['start_date'] = $start_date;
        $param['end_date'] = $end_date;
        $param['data'] = $response->getBody()->getContents();

        //organizing data for the date ranges
        $organized_data = $this->organizedata($param, 'date_range');

        return $organized_data;

    }

    public function organizedata($param, $type)
    {
        //type in case we need to add some other type in future currently -> date-range
        if ($type == 'date_range') {
            $start_date = $param['start_date'];
            $end_date = $param['end_date'];
            $json_data = $param['data'];

            $start_date_timestamp = strtotime($start_date . ' 00:00:00');
            $end_date_timestamp = strtotime($end_date . ' 23:59:59');

            $data = json_decode($json_data, true);

            if(!empty($data['prices'])) {
                $data = array_filter($data['prices']);

                //Json query to get data for required date range
                $data = collect($data)->where("date", ">=", "{$start_date_timestamp}")->where("date", "<=", "{$end_date_timestamp}")->sortByDesc('date')->all();
            }
            else{
                $data = array();
            }
        } else {
            //type not identified
            $data = array();
        }
        return $data;
    }

}
