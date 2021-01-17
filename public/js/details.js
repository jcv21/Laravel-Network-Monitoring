let network = "network";
let parameters = $("#bytes").data("id");
let token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };

$(document).ready(function(){

    getTraffic(network);

});


function getTraffic(param){

    $.ajax({
        headers: token,
        url: "/details/"+parameters+"/" + param,
        method: "GET",
        success:function(data) {
            const packets = [];
            const bytes = [];

            for(const i in data) {
                packets.push(data[i].packets);
                bytes.push(data[i].bytes);
            }

            const dom = document.getElementById("bytes");
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