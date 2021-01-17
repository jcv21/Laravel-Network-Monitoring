@extends('layout.app')


@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Device<small></small></h2>
                <div class="clearfix"></div>
            </div>  
            <div>
                <br>
                <div id="device_container">
                    <div class="row">
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Device IP: {{   $object['ip_address']  }}
                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Device MAC Address: {{   $object['mac_address']  }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Incoming Bytes: {{   $object['incoming_bytes']  }}
                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            Outgoing Bytes: {{   $object['outgoing_bytes']  }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        Incoming Packets: {{   $object['incoming_packets']  }}
                        </div>
                        <div class="form-group col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        Outgoing Packets: {{   $object['outgoing_packets']  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Network Traffic<small></small></h2>
                <div class="clearfix"></div>
            </div>  
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div style="height: 500px; overflow: auto;" id="bytes" data-id="{{ request()->traffic_sourceIP }}"></div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
    <script src="{{ url('js/details.js') }}"></script>
@endsection