<?php 
// PHP code to extract IP  


function getVisIpAddr() { 
      
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
        return $_SERVER['HTTP_CLIENT_IP']; 
    } 
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
        return $_SERVER['HTTP_X_FORWARDED_FOR']; 
    } 
    else { 
        return $_SERVER['REMOTE_ADDR']; 
    } 
} 
  
// Store the IP address 
$vis_ip = getVisIPAddr(); 
  
// Display the IP address 
echo $vis_ip; 

// PHP code to obtain country, city,  
// continent, etc using IP Address 
  
$ip = '103.15.60.106'; 
  
// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents( 
    "http://www.geoplugin.net/json.gp?ip=" . $ip)); 
   
echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n"; 
echo 'City_name: ' . $ipdat->geoplugin_city . "\n"; 
echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n"; 
echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n"; 
echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n"; 
echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n"; 
echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n"; 
echo 'Timezone: ' . $ipdat->geoplugin_timezone; 

?> 