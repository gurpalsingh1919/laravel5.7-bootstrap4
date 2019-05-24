<?php

return array(
/** set your paypal credential **/
'client_id' =>'AQx9ley3NGV2ybfnFPIZex9M0ww6BdQ97tZRoxppCzPUwFzY5h8GRysJcOWjz7mzK1l9lVUnJw86Y-Gd',
'secret' => 'ELuHdOiqwnUOiP6v5jP4S74r12uGQaBQBPoh6dVllaEhTZrLUPjGyBJInsoJtbp8Ep8OJaG_th4ntVGP',
/**
* SDK configuration 
*/
'settings' => array(
    /**
    * Available option 'sandbox' or 'live'
    */
    'mode' => 'sandbox',
    /**
    * Specify the max request time in seconds
    */
    'http.ConnectionTimeOut' => 10000,
    /**
    * Whether want to log to a file
    */
    'log.LogEnabled' => true,
    /**
    * Specify the file that want to write on
    */
    'log.FileName' => storage_path() . '/logs/paypal.log',
    /**
    * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
    *
    * Logging is most verbose in the 'FINE' level and decreases as you
    * proceed towards ERROR
    */
    'log.LogLevel' => 'FINE'
    ),
);