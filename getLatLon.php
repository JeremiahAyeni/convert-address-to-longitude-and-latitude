<?php
//this app seeks to first check if the lon and lat already exist, if not then it queries the google API 


// function to get  the address
function get_lat_long($address){
    $latlon = [];

    $address = str_replace(" ", "+", $address);
    $region = 'NG'; //for specific region you can specify else leave empty
    $API_KEY= ''; //get key from google

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&key=$API_KEY");
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    
    $latlon = $lat;
    $latlon = $long;
    
    return $latlon;
}

function get_lat_long_m($address){
    $latlon = [];

    $address = str_replace(" ", "%20", $address);
    $userRegion='NG'; //for specific region you can specify else leave empty
    $API_KEY= ''; //get key from google

    $json = file_get_contents("http://dev.virtualearth.net/REST/v1/Locations?q=$address&ur=$userRegion&key=$API_KEY 
    ");
    $json = json_decode($json);
    
    $lat = $json->{'resourceSets'}[0]->{'resources'}[0]->{'point'}->{'coordinates'}[0];
    $long = $json->{'resourceSets'}[0]->{'resources'}[0]->{'point'}->{'coordinates'}[1];
    
    $latlon = $lat;
    $latlon = $long;
    
    return $latlon;
}




