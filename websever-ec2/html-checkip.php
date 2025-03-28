<!DOCTYPE html>

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        h4,
        h5 {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h5>Instance is running with the following IPs:</h5>
        <div class="ip-box">
            <h4>Private IP:
                <?= htmlspecialchars($private_ip, ENT_QUOTES, 'UTF-8') ?>
            </h4>
            <h4>Public IP:
                <?= isset($public_ip) ? htmlspecialchars($public_ip, ENT_QUOTES, 'UTF-8') : "N/A" ?>
            </h4>
        </div>
    </div>

</body>

</html>