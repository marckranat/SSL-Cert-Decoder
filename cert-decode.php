<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pem = $_POST['pem'];

    $cert = openssl_x509_parse($pem);

    // Extract required information from the certificate
    $common_name = $cert['subject']['CN'];
    $alt_names = $cert['extensions']['subjectAltName'];
    $org = $cert['subject']['O'];
    $state = $cert['subject']['ST'];
    $country = $cert['subject']['C'];
    $valid_from = date('Y-m-d H:i:s', $cert['validFrom_time_t']);
    $valid_to = date('Y-m-d H:i:s', $cert['validTo_time_t']);
    $issuer = $cert['issuer']['CN'];
    $serial_number = $cert['serialNumber'];

    // Display the extracted information
    echo "Common Name: $common_name<br>";
    echo "Subject Alternative Names: $alt_names<br>";
    echo "Organization: $org<br>";
    echo "State: $state<br>";
    echo "Country: $country<br>";
    echo "Valid From: $valid_from<br>";
    echo "Valid To: $valid_to<br>";
    echo "Issuer: $issuer<br>";
    echo "Serial Number: $serial_number<br>";
}
?>

<form method="post">
    <label for="pem">Certificate in PEM format:</label><br>
    <textarea id="pem" name="pem" rows="10" cols="50"></textarea><br>
    <input type="submit" value="Submit">
</form>
