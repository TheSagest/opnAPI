<?php
//Reduce errors
error_reporting(~E_WARNING);
echo "Starting <br>";

$listenIP = "0.0.0.0";
$port = 50222;

//Create a UDP socket
if(!($sock = socket_create(AF_INET,
    SOCK_DGRAM,
    0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created <br>";

// Bind the source address
if( !socket_bind($sock,
    $listenIP,
    $port) )
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);

    die("Could not bind socket : [$errorcode] $errormsg \n");
}

echo "Socket bind OK <br>";

//Do some communication, this loop can handle multiple clients
while(1)
{
	echo "Waiting for data ... <br>";

	//Receive some data
	$r = socket_recvfrom($sock,
        $buf,
        1024,
        0,
        $remote_ip,
        $remote_port);

	echo "$remote_ip : $remote_port -- " . $buf;

	//Send back the data to the client.old
	socket_sendto($sock,
        "OK " . $buf ,
        100 ,
        0 ,
        $remote_ip ,
        $remote_port);
}

socket_close($sock);