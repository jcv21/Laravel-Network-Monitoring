<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mikehaertl\wkhtmlto\Pdf;

class ReportController extends Controller
{
    /**
     *  Handles index route
     * 
     *  @return Response
     */
    public function index(){
        if(Auth::check()){
            return view("report");
        }else{
            return view('login');
        }
    }

    /**
     *  Preview the pdf
     * 
     *  @return Response
     */
    public function preview(Request $request)
    {
        $data = [];

        $title = $this->get_report_name($request->input('InputReportType'));
        $type = $request->input('InputReportType');
        $data['title'] = $title;
        $data['type'] = $type;
        $data['date_from'] = date("M d, Y", strtotime($request->input('InputSDate')));
        $data['date_to'] = date("M d, Y", strtotime($request->input('InputEDate')));
        $data['InputSDate'] = $request->input('InputSDate');
        $data['InputEDate'] = $request->input('InputEDate');

        $data['upload_bandwidth'] = $this->upload_bandwidth($request->input('InputSDate'), $request->input('InputEDate'));
        $data['dowload_bandwidth'] = $this->download_bandwidth($request->input('InputSDate'), $request->input('InputEDate'));
        $data['incoming_bytes'] = $this->incoming_bytes($request->input('InputSDate'), $request->input('InputEDate'));
        $data['outgoing_bytes'] = $this->outgoing_bytes($request->input('InputSDate'), $request->input('InputEDate'));
        $data['incoming_packets'] = $this->incoming_packets($request->input('InputSDate'), $request->input('InputEDate'));
        $data['outgoing_packets'] = $this->outgoing_packets($request->input('InputSDate'), $request->input('InputEDate'));

        return view("report_pdf", ['data' => $data]);
    }

    /**
     *  Generate PDF Report
     * 
     *  @return File
     */
    public function generate_report(Request $request){
        $data = [];
        $type = $request->input('InputReportType');
        $data['title'] = $request->input('report_name');
        $data['date_from'] = $request->input('report_start_date');
        $data['date_to'] = $request->input('report_end_date');
        $data['type'] = $type;

        $data['upload_bandwidth'] = $this->upload_bandwidth($request->input('InputSDate'), $request->input('InputEDate'));        
        $data['dowload_bandwidth'] = $this->download_bandwidth($request->input('InputSDate'), $request->input('InputEDate'));
        $data['incoming_bytes'] = $this->incoming_bytes($request->input('InputSDate'), $request->input('InputEDate'));
        $data['outgoing_bytes'] = $this->outgoing_bytes($request->input('InputSDate'), $request->input('InputEDate'));
        $data['incoming_packets'] = $this->incoming_packets($request->input('InputSDate'), $request->input('InputEDate'));
        $data['outgoing_packets'] = $this->outgoing_packets($request->input('InputSDate'), $request->input('InputEDate'));
        $render = view('report.bandwidth', ['data' => $data])->render();
            
        $pdf = new Pdf;
        $pdf->addPage($render);
        $pdf->setOptions(['javascript-delay' => 5000]);
        $pdf->saveAs(public_path('report_pdf.pdf'));

        return response()->download(public_path('report_pdf.pdf'));
    }

    /**
     *  Report Name
     * 
     *  @return String
     */
    public function get_report_name($report_type){
        if($report_type == 1){
            $name = "Bandwidth Used";
        }else if($report_type == 2){
            $name = "Network Traffic";
        }
        return $name;
    }

    /**
     *  Retrieve Upload Bandwidth
     *  
     *  @param Date $inputSDate
     *  @param Date $inputEDate
     *  @return Array
     */
    public function upload_bandwidth($inputSDate, $inputEDate){
        return DB::select("SELECT date(`bandwidth_dateTime`) AS `dtime`, AVG(`bandwidth_up_speed`) 'bandwidth_upload' FROM `network_bandwidth` WHERE DATE(`bandwidth_dateTime`) BETWEEN :start AND :end GROUP BY date(`bandwidth_dateTime`)", ['start' => $inputSDate, 'end' => $inputEDate]);
    }

    /**
     *  Retrieve Download Bandwidth
     * 
     *  @param Date $inputSDate
     *  @param Date $inputEDate
     *  @return Array
     */
    public function download_bandwidth($inputSDate, $inputEDate){
        return DB::select("SELECT date(`bandwidth_dateTime`) AS `dtime`, AVG(`bandwidth_dl_speed`) 'bandwidth_donwld' FROM `network_bandwidth` WHERE DATE(`bandwidth_dateTime`) BETWEEN :start AND :end GROUP BY date(`bandwidth_dateTime`)", ['start' => $inputSDate, 'end' => $inputEDate]);
    }

    /**
     *  Retrieve incoming bytes
     * 
     *  @param Date $inputSDate
     *  @param Date $inputEDate
     *  @return Integer
     */
    public function incoming_bytes($inputSDate, $inputEDate){
        return DB::table('network_traffic')
                ->select(DB::raw('SUM(traffic_bytes) AS in_bytes, date(traffic_datetime) AS dtime_in'))
                ->where('traffic_type', '=', 1)
                ->whereBetween(DB::raw("date(traffic_datetime)"), [$inputSDate, $inputEDate])
                ->groupBy(DB::raw('date(traffic_datetime)'))
                ->get();
    }

    /**
     *  Retrieve incoming packets in the device
     * 
     *  @return Integer
     */
    public function incoming_packets($inputSDate, $inputEDate){
        return DB::table('network_traffic')
                ->select(DB::raw('COUNT(*) AS in_packets, date(traffic_datetime) AS dtime_in'))
                ->where('traffic_type', '=', 1)
                ->whereBetween(DB::raw("date(traffic_datetime)"), [$inputSDate, $inputEDate])
                ->groupBy(DB::raw('date(traffic_datetime)'))
                ->get();
    }

    /**
     *  Retrieve outgoing bytes in the device
     * 
     *  @return Integer
     */
    public function outgoing_bytes($inputSDate, $inputEDate){
        return DB::table('network_traffic')
                ->select(DB::raw('SUM(traffic_bytes) AS out_bytes, date(traffic_datetime) AS dtime_out'))
                ->where('traffic_type', '=', 2)
                ->whereBetween(DB::raw("date(traffic_datetime)"), [$inputSDate, $inputEDate])
                ->groupBy(DB::raw('date(traffic_datetime)'))
                ->get();
    }

    /**
     *  Retrieve outgoing packets in the device
     * 
     *  @return Integer
     */
    public function outgoing_packets($inputSDate, $inputEDate){
        return DB::table('network_traffic')
                ->select(DB::raw('COUNT(*) AS out_packets, date(traffic_datetime) AS dtime_out'))
                ->where('traffic_type', '=', 2)
                ->whereBetween(DB::raw("date(traffic_datetime)"), [$inputSDate, $inputEDate])
                ->groupBy(DB::raw('date(traffic_datetime)'))
                ->get();
    }
}
