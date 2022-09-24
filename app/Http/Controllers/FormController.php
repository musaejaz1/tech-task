<?php

namespace App\Http\Controllers;

use App\Jobs\EmailQueueJob;
use App\Lib\HistoricalDataApi;
use Exception;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        //View with the actual form
        return view('historical-data-form');
    }

    public function process(Request $request)
    {
        // Declaring empty variable in case an exception is thrown
        $data['Symbol'] = '';

        // Check if company symbol is not empty search through Json file to check if it is a valid symbol
        if (!empty($request->company_symbol)) {
            $json_file_url = 'https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json';
            $json_file_data = file_get_contents($json_file_url);
            $data_file = json_decode($json_file_data, true);

            $data_file = array_filter($data_file);

            $data = collect($data_file)->where("Symbol", "=", "{$request->company_symbol}")->all();
            $data = reset($data);
        }

        // Validate form fields
        $request->validate([
            'company_symbol' => 'required|in:' . $data['Symbol'],
            'start_date' => 'required|date|before_or_equal:end_date|before_or_equal:now',
            'end_date' => 'required|date|after_or_equal:start_date|before_or_equal:now',
            'email' => 'required|email:rfc,dns',
        ]);

        // Array to be passed to View
        $view_data = array();
        $view_data['companysymbol'] = $request->company_symbol;
        $view_data['companyname'] = $data['Company Name'];
        $view_data['startdate'] = $request->start_date;
        $view_data['enddate'] = $request->end_date;
        $view_data['email'] = $request->email;

        //Array to pass for email queue
        $email['body'] ='from ' . $view_data['startdate'] . ' to ' . $view_data['enddate'];
        $email['subject'] = $view_data['companyname'];
        $email['to'] = $view_data['email'];
        $view_data['email-status'] = true;
        try {
            //Queue Email
            EmailQueueJob::dispatch($email);
            $view_data['email-status'] = true;
        } catch (Exception $e) {
            //Email sent failed.
            $view_data['email-status'] = false;
        }

        //New object for calling api
        $historical_data_api = new HistoricalDataApi($view_data['companysymbol']);
        $view_data['$historical_data'] = $historical_data_api->gethistoricaldata($view_data['startdate'], $view_data['enddate']);
        return view('historical-data', ['data' => $view_data]);
    }

}
