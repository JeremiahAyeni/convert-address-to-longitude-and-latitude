# convert-address-to-longitude-and-latitude
Convert any address to longitude and latitude using PHP
Don't stress yourself, fork the code here and easily use GOOGLE or BING depending on your need
## Today, Google charges for every API request, so its more advisable to check our code to make sure we only make those request when needed. 
## I have added BING API request format and also made it easier to use as it can be used without any payment unlike Google. 

### Documentation/Note
* To successfully use this, you need to understand a little bit of PHP, so as to easily modify to suit your need
* The function get_lat_long uses GOOGLE API and receives an argument called address. The address for which you want to decode into Longitude and Latitude 
* The function get_lat_long_m is same as the one above, the difference is, it uses BING API
* The array_push_multi_assoc function creates an array that stores key-value arrays. e.g ['a':1, 'b':2] where a:1 is at index 0 and it has a key of 'a' and value of 1
* The getValuesFromDB function checks the databse first and if the value doesnt exist, it then calls the function that queries the API
* The updateDBValues function updates the values in the database, assuming that the address already exist in the database but no Longitude and Latitude 
* I hope this is useful to someone. Goodluck in your project!
