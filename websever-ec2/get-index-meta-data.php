<?php

  echo "<table class='table table-bordered'>";
  echo "<tr><th>Meta-Data</th><th>Value</th></tr>";

  # Get the instance ID from meta-data and print to the screen
  $instance_id = shell_exec('ec2-metadata --instance-id 2> /dev/null | cut -d " " -f 2');
  # if its not set make it 0
  if (empty($instance_id)) {
      $instance_id = 0;
  }
  echo "<tr><td>InstanceId</td><td><i>";
  echo $instance_id;
  "</i></td><tr>";

  # Availability Zone
  $az = shell_exec('ec2-metadata -z 2> /dev/null | cut -d " " -f 2');
  # if its not set make it 0
     if (empty($az)) {
         $az = 0;
  }
  echo "<tr><td>Availability Zone</td><td><i>";
  echo  $az;
  "</i></td><tr>";

  echo "</table>";

?>

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