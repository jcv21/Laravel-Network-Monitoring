let users = "users";
let bandwidth = "bandwith";
let activity = "network_activity";
let traffic = "traffic";
let ipactivity = "ipactivity";
let ip_list = "ip";
let token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };
let chartData;

$(document).ready(function(){

    getTotalUsers(users);
    getTotalBandwidth(bandwidth);
    getTotalActivity(activity);
    network_traffic(traffic);
    ip_traffic_activity(ipactivity);
    getIP(ip_list);

    setInterval(function(){
        getTotalUsers(users);
        getTotalBandwidth(bandwidth);
        getTotalActivity(activity);
        network_traffic(traffic);
        ip_traffic_activity(ipactivity);
        getIP(ip_list);
    }, 20000);

});

function getTotalUsers(param){

    $.ajax({
        headers: token,
        url: "/dashboard/" + param,
        method: "GET",
        success:function(data){
            $("#myDivCount").html(data);
        }
    });

}

function getTotalBandwidth(param){

    $.ajax({
        headers: token,
        url: "/dashboard/" + param,
        method: "GET",
        success:function(data){
            $("#myDivBand").html(data);
        }
    });

}

function getTotalActivity(param){

    $.ajax({
        headers: token,
        url: "/dashboard/" + param,
        method: "GET",
        success:function(data){
            $("#myDivTut").html(data);
        }
    });

}

function getIP(param){

    $.ajax({
        headers: token,
        url: "/dashboard/" + param,
        method: "GET",
        success:function(data){
            $("#myDiv2").html(data);
        }
    });

}

function network_traffic(param){
    $.ajax({
        headers: token,
        url: "/dashboard/" + param,
        method: "GET",
        success:function(data) {
            const packets = [];
            const bytes = [];

            for(const i in data) {
                packets.push(data[i].packets);
                bytes.push(data[i].bytes);
            }

            const dom = document.getElementById("container");
            const myChart = echarts.init(dom);
            const option = {
                title: {
                    text: ''
                },
                legend: {
                    data: ['Packets (In / Out)', 'Bytes (In / Out)'],
                    align: 'left'
                },
                toolbox: {
                    // y: 'bottom',
                    feature: {
                        magicType: {
                            type: ['stack', 'tiled']
                        },
                        dataView: {},
                        saveAsImage: {
                            pixelRatio: 2
                        }
                    }
                },
                tooltip:{},
                xAxis: {
                    data: ['Packets(In)        Bytes(In)','Packets(Out)       Bytes(Out)'],
                    silent: false,
                    splitLine: {
                        show: false
                    }
                },
                yAxis: {
                    
                },
                series: [{
                    name: 'Packets (In / Out)',
                    type: 'bar',
                    data: packets,
                    animationDelay: function (idx) {
                        return idx * 10;
                    }
                }, {
                    name: 'Bytes (In / Out)',
                    type: 'bar',
                    data: bytes,
                    animationDelay: function (idx) {
                        return idx * 10 + 100;
                    }
                }],
                animationEasing: 'elasticOut',
                animationDelayUpdate: function (idx) {
                    return idx * 5;
                }
            };
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }
        }
    });
}


function ip_traffic_activity(param){

    $.ajax({
        headers: token,
        url: "/dashboard/" + param,
        method: "GET",
        success:function(data) {
            chartData = data;
            var dom = document.getElementById("container2");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            app.title = 'Popo';

            option = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                
            },
            series: [
                    {
                    name:'Sevices',
                    type:'pie',
                    radius: ['40%', '55%'],
                    dataFormat: 'json',
                    label: {
                        normal: {
                        formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
                        backgroundColor: '#eee',
                        borderColor: '#aaa',
                        borderWidth: 1,
                        borderRadius: 4,
                        // shadowBlur:3,
                        // shadowOffsetX: 2,
                        // shadowOffsetY: 2,
                        // shadowColor: '#999',
                        // padding: [0, 7],
                            rich: {
                                a: {
                                color: '#999',
                                lineHeight: 22,
                                align: 'center'
                                },
                                // abg: {
                                //     backgroundColor: '#333',
                                //     width: '100%',
                                //     align: 'right',
                                //     height: 22,
                                //     borderRadius: [4, 4, 0, 0]
                                // },
                                hr: {
                                borderColor: '#aaa',
                                width: '100%',
                                borderWidth: 0.5,
                                height: 0
                                },
                                b: {
                                fontSize: 16,
                                lineHeight: 33
                                },
                                per: {
                                color: '#eee',
                                backgroundColor: '#334455',
                                padding: [2, 4],
                                borderRadius: 2
                                }
                            }
                        }
                    },
                    data: chartData
                    }
                ]
            };
            if (option && typeof option === "object") {
            myChart.setOption(option, true);
            }
        }

    });

}


/* function getApplications(param){

    $.ajax({
        headers: token,
        method: "GET",
        url: "/dashboard/" + param,
        success: function(data){
            console.log(data);
            var output = "";
            $.each(data, function(i,val){
                output += "<div>"+val.path+"</div>";
            });
            $("#myDiv").html(output);
        }
    });

} */