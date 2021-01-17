<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DashboardController extends Controller
{
    /**
     *  Get the user's total number
     * 
     *  @return Integer
     */
    public function totaluser(){
        return User::get()->count();
    }

    /**
     *  Get the total bandwidth used
     * 
     *  @return Float
     */
    public function total_bandwidth_user(){
        $upload = DB::table('network_bandwidth')
                ->select('bandwidth_up_speed')
                ->latest('bandwidth_dateTime')
                ->first()
                ->bandwidth_up_speed;

        $download = DB::table('network_bandwidth')
                ->select('bandwidth_dl_speed')
                ->latest('bandwidth_dateTime')
                ->first()
                ->bandwidth_dl_speed;

        $users = $this->totaluser();

        $upload_bandwith = (float)$upload * (float)$users;
        $donwload_bandwidth = (float)$download * (float)$users;
        $bandwidth = $upload_bandwith + $donwload_bandwidth;
        return $bandwidth;
    }

    /**
     *  Get the total activity done
     * 
     *  @return Float
     */
    public function total_activity_done(){
        return DB::table('network_traffic')->count();
    }

    /**
     *  Network traffic
     * 
     *  @return Array
     */
    public function network_traffic(){
        $incoming = $this->incoming_traffic();
        $outgoing = $this->outgoing_traffic();

        $data = array("incoming" => $incoming, "outgoing" => $outgoing);
        return $data;
    }

    /**
     *  Incoming Network Traffic
     * 
     *  @return Array
     */
    public function incoming_traffic(){
        $packets = $this->incoming_packets();
        $bytes = $this->incoming_bytes();

        $data = array("bytes" => $bytes, "packets" => $packets);
        return $data;
    }

    /**
     *  Outgoin Network Traffic
     * 
     *  @return Array
     */
    public function outgoing_traffic(){
        $packets = $this->outgoing_packets();
        $bytes = $this->outgoing_bytes();

        $data = array("bytes" => $bytes, "packets" => $packets);
        return $data;
    }

    /**
     *  Incoming packets
     * 
     *  @return Integer
     */
    public function incoming_packets(){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 1)
               ->get()
               ->count();
    }

    /**
     *  Outgoing packets
     * 
     *  @return Integer
     */
    public function outgoing_packets(){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 2)
               ->get()
               ->count();
    }

    /**
     *  Incoming Bytes
     * 
     *  @return Float
     */
    public function incoming_bytes(){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 1)
               ->sum('traffic_bytes');
    }

    /**
     *  Outgoing Bytes
     * 
     *  @return Float
     */
    public function outgoing_bytes(){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 2)
               ->sum('traffic_bytes');
    }

    /**
     *  Clear Network Activity
     * 
     *  @return Response
     */
    public function clear_activity(){
        $remove = DB::table('network_traffic')->delete();
        if($remove){
            notify()->success("Network Traffic is cleared","Success","topRight");
            return redirect()->intended('dashboard');
        }else{
            notify()->error("Network Traffic is not cleared","Error","topRight");
            return redirect()->intended('dashboard');
        }
    }

    /**
     *  Retrieves Device Activity
     * 
     *  @return Array
     */
    public function device_activity(){
        $activity = DB::table('network_traffic')
                    ->select(
                        'traffic_sourceIP',
                        DB::raw('COUNT(*) AS NUM')  
                    )
                    ->where('traffic_type', '=', 1)
                    ->groupBy('traffic_sourceIP')
                    ->get();

        $array = [];

        foreach($activity as $row){

            $array[] = Array("name" => $row->traffic_sourceIP, "value" => $row->NUM);

        }

        return $array;
    }

    /**
     *  Retrieves the ip's connected to the network
     * 
     *  @return Array
     */
    public function ip(){
        $ip = DB::table('network_traffic')
              ->select('traffic_sourceIP')
              ->where('traffic_type', '=', 1)
              ->groupBy('traffic_sourceIP')
              ->get();

        $output = "";
        foreach($ip as $row){
            $output .= "<div><a href='details/$row->traffic_sourceIP'>".$row->traffic_sourceIP."</a></div>";
        }

        return $output;
    }

    /**
     *  Retrieves the applications that is used in the network
     * 
     *  @return Array
     */
    /* public function ip_applications(){
        $ip =  DB::table('network_traffic')
               ->select('traffic_destinationIP')
               ->where('traffic_type', '=', 1)
               ->groupBy('traffic_destinationIP')
               ->get();
        $value = [];
        foreach($ip as $rows){
            if($rows->traffic_destinationIP == request()->ip() || $rows->traffic_destinationIP == '192.168.10.116' || $rows->traffic_destinationIP == '192.168.10.1'){

            }else{
                $url = gethostbyaddr($rows->traffic_destinationIP);
                if(filter_var($url, FILTER_VALIDATE_IP) || $url == FALSE){

                }else{
                    $host = str_ireplace('www.', '', parse_url($url));
                    //$output = dns_get_record($host, DNS_A + DNS_NS);
                    $value[] = $host;
                }
            }

        }

        return $value;
    } */
}
