<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /**
         * Service Account demo.
         */
        $sheets = Sheets::spreadsheet(config('sheets.post_spreadsheet_id'))

                        ->sheetById(config('sheets.post_sheet_id'))

                        ->all();

        //$header = $sheets->pull(0);
        // $header = [
        //     'name',
        //     'message',
        //     'created_at',
        // ];

        // $posts = Sheets::collection($header, $sheets);
        // $posts = $posts->reverse()->take(10);
        $posts = array();

        foreach ($sheets AS $data) {

            $posts[] = array(

                'name' => $data[0],

                'message' => $data[1],

                'created_at' => $data[2],

            );

        }

        return view('welcome')->with(compact('posts'));
    }
}