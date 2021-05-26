import pyshark
import mysql.connector
import ipaddress
import speedtest
import socket
from datetime import datetime


conn = mysql.connector.connect(
    host = 'localhost',
    user = 'root',
    password='',
    database='traffic')


mycursor = conn.cursor()



def capture_live_packets(network_interface, network):
    capture = pyshark.LiveCapture(interface=network_interface)
    print("Processing...")
    #get_network_bandwidth(network_interface)
    for raw_packet in capture.sniff_continuously():
        get_packet_details(raw_packet, network)



def get_network_bandwidth(network_interface):
    s = speedtest.Speedtest()
    s.get_config()
    s.get_best_server()

    dl_speed = s.download()
    dl_speed_mbps = round(dl_speed / 1000 / 1000, 1)

    up_speed = s.upload()
    up_speed_mbps = round(up_speed / 1000 / 1000, 1)

    now = datetime.now()
    c_datetime = now.strftime("%Y-%m-%d %H:%M:%S")

    sql = "INSERT INTO network_bandwidth (bandwidth_network_intf, bandwidth_dl_speed, bandwidth_up_speed, bandwidth_dateTime) VALUES (%s, %s, %s, %s)"
    val = (network_interface, dl_speed_mbps, up_speed_mbps, c_datetime)
    mycursor.execute(sql, val)

    conn.commit()



def get_packet_details(packet, network):
    """
    This function is designed to parse specific details from an individual packet.
    :param packet: raw packet from live capture using TShark
    :return: specific packet details
    """
    try:
        #protocol = packet.transport_layer
        #source_port = packet[packet.transport_layer].srcport
        #destination_port = packet[packet.transport_layer].dstport
        #packet_type = packet.transport_layer
        source_address = packet.ip.src
        destination_address = packet.ip.dst
        source_mac = packet.eth.src
        destination_mac = packet.eth.dst
        packet_bytes = packet.length
        packet_time = packet.sniff_time
        an_address = ipaddress.ip_address(source_address)
        a_network = ipaddress.ip_network(network)
        address_in_network = an_address in a_network

        if address_in_network == True:
            traffic_type = 1
        elif address_in_network == False:
            traffic_type = 2
        elif address_in_network == None:
            traffic_type = 2
        else:
            traffic_type = 1

        sql = "INSERT INTO network_traffic (traffic_bytes, traffic_sourceIP, traffic_destinationIP, traffic_sourcemac, traffic_destinationmac, traffic_datetime, traffic_type) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        val = (packet_bytes,  source_address, destination_address, source_mac, destination_mac, packet_time, traffic_type)
        mycursor.execute(sql, val)

        conn.commit()

    except AttributeError as e:
        print(e)
        pass



capture_live_packets('enp2s0', '192.168.10.0/24')
