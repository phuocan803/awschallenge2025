<?php
# Thực hiện lệnh vmstat đơn giản và lấy thời gian rảnh của CPU hiện tại
$idleCpu = exec('vmstat 1 2 | awk \'{ for (i=1; i<=NF; i++) if ($i=="id") { getline; getline; print $i }}\'');

# In ra thời gian rảnh, trừ đi 100 để có được mức sử dụng CPU hiện tại
echo "<br /><p>Current CPU Load: <b>";
echo 100 - $idleCpu;
echo "%</b></p>";
?>