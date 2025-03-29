<?php
// Lấy token từ AWS Metadata Service v2
$token_url = "http://169.254.169.254/latest/api/token";
$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-aws-ec2-metadata-token-ttl-seconds: 21600"]);
$token = curl_exec($ch);
curl_close($ch);

// Hàm lấy dữ liệu từ AWS Metadata Service
function get_metadata($path, $token) {
    $url = "http://169.254.169.254/latest/meta-data/$path";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-aws-ec2-metadata-token: $token"]);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// Lấy địa chỉ IP
$private_ip = get_metadata("local-ipv4", $token);
$public_ip = get_metadata("public-ipv4", $token);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Check IP</title>
    <style>
        h1 { color: green; }
        h4 { color: red; }
    </style>
</head>
<body>
    <h1>Welcome to AWS Instance</h1>
    <h4>You are running this instance from the following IPs:</h4>
    <p><strong>Private IP:</strong> <?php echo $private_ip; ?></p>
    <p><strong>Public IP:</strong> <?php echo $public_ip ? $public_ip : "N/A"; ?></p>
</body>
</html>
