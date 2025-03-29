<!DOCTYPE html>
<style>
    p {
            margin: 4px 0; 
        }
</style>
<body>
<div class="container">
    <h2>Check IP success!</h2>
    <h5>Instance is running with the following IPs:</h5>
    
    <div class="ip-box">
        <p><strong>Private IP:</strong> <?= htmlspecialchars($private_ip, ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Public IP:</strong> <?= isset($public_ip) ? htmlspecialchars($public_ip, ENT_QUOTES, 'UTF-8') : "N/A" ?></p>
    </div>
</div>

</body>
</html>
