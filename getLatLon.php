<?php
//this app seeks to first check if the lon and lat already exist, if not then it queries the API 


// function to get  the address

//use GOOGLE API
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

//use BING API
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

//This saves an key_value array into another array
function array_push_multi_assoc($array, $key, $value)
{
  $array[$key] = $value;
  return $array;
}

//This is the 
function getValuesFromDB()
{
  $tempValues = [];
  $values = $this->getAllValues();//this gets all the values from the database

  foreach ($values as $value) {
    //add hospital claims to an associative array
    if (empty($value['lon']) || empty($value['lat'])) {

      $latlon = $this->get_lat_long($value['address']); // You can also use BING API
      array_push($latlon, $value['name']);
      updateDBValues($latlon[0], $latlon[1], $value['id']);
      $tempValues = $this->array_push_multi_assoc($tempValues, $value['description'], $latlon);
    } else {
      $tempValues = $this->array_push_multi_assoc($tempValues, $value['description'], [$value['lat'], $value['lon'], $value['name']]);
    }
  }

  return $tempValues;
}

function updateDBValues($lat, $lon, $id)
{
  $query = "UPDATE DBColumn SET lat = $lat, lon = $lon WHERE id = '$id'";
  return 0;//return 1 for successful execution of the query result;
}