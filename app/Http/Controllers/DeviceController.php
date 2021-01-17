<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{    
    /**
     *  Get the device details
     * 
     *  @return Array
     */
    public function device_details($traffic_sourceIP){
        $mac_address = DB::table('network_traffic')
                    ->select('traffic_sourcemac')
                    ->where('traffic_sourceIP', '=', $traffic_sourceIP)
                    ->latest('traffic_datetime')
                    ->first()
                    ->traffic_sourcemac;
        $incoming_bytes = $this->incoming_bytes($traffic_sourceIP);
        $incoming_packets = $this->incoming_packets($traffic_sourceIP);
        $outgoing_bytes = $this->outgoing_bytes($traffic_sourceIP);
        $outgoing_packets = $this->outgoing_packets($traffic_sourceIP);
        
        $object = array("ip_address" => $traffic_sourceIP, "mac_address" => $mac_address, "incoming_bytes" => $incoming_bytes, "incoming_packets" => $incoming_packets, "outgoing_bytes" => $outgoing_bytes, "outgoing_packets" => $outgoing_packets);

        if(Auth::check()){
            $redirect = view("details", compact('object'));
        }else{
            $redirect = view("login");
        }
        return $redirect;
    }

    /**
     *  Retrieve IP's Network traffic
     * 
     *  @return Array
     */
    public function network_traffic($traffic_sourceIP){
        $incoming = $this->incoming_traffic($traffic_sourceIP);
        $outgoing = $this->outgoing_traffic($traffic_sourceIP);

        $data = array("incoming" => $incoming, "outgoing" => $outgoing);
        return $data;
    }

    /**
     *  Incoming Network Traffic
     * 
     *  @return Array
     */
    public function incoming_traffic($ip){
        $packets = $this->incoming_packets($ip);
        $bytes = $this->incoming_bytes($ip);

        $data = array("bytes" => $bytes, "packets" => $packets);
        return $data;
    }

    /**
     *  Outgoin Network Traffic
     * 
     *  @return Array
     */
    public function outgoing_traffic($ip){
        $packets = $this->outgoing_packets($ip);
        $bytes = $this->outgoing_bytes($ip);

        $data = array("bytes" => $bytes, "packets" => $packets);
        return $data;
    }

    /**
     *  Retrieve incoming bytes in the device
     * 
     *  @return Integer
     */
    public function incoming_bytes($ip){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 1, 'and', 'traffic_sourceIP', '=', $ip)
               ->sum('traffic_bytes');
    }

    /**
     *  Retrieve incoming packets in the device
     * 
     *  @return Integer
     */
    public function incoming_packets($ip){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 1, 'and', 'traffic_sourceIP', '=', $ip)
               ->get()
               ->count();
    }

    /**
     *  Retrieve outgoing bytes in the device
     * 
     *  @return Integer
     */
    public function outgoing_bytes($ip){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 2, 'and', 'traffic_destinationIP', '=', $ip)
               ->sum('traffic_bytes');
    }

    /**
     *  Retrieve outgoing packets in the device
     * 
     *  @return Integer
     */
    public function outgoing_packets($ip){
        return DB::table('network_traffic')
               ->where('traffic_type', '=', 2, 'and', 'traffic_destinationIP', '=', $ip)
               ->get()
               ->count();
    }
}
