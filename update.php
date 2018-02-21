<?php
$ch = curl_init("https://tools.echosystem.fr/Password/htaccess/version.txt");

curl_setopt($ch, CURLOPT_NOBODY, true);
curl_exec($ch);
$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// $retcode >= 400 -> not found, $retcode = 200, found.
echo $retcode;
curl_close($ch);
?>

<?php
define('REMOTE_VERSION', 'https://tools.echosystem.fr/Password/htaccess/version.txt');
define('VERSION', '1.0.2');
$script = file_get_contents(REMOTE_VERSION);
$version = VERSION;
if($version==$script) {

    echo "<div class=success> 
    <p>You have the latest version!</p> 
    </div>";
} else {
    echo "<div class=error> 
    <p>There is a update available!</p> 
    </div>";
}

?>
