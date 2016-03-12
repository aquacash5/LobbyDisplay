<?php
    $file=fopen("web.log", "a") or exit("Fail");
    $date = new DateTime();
    fwrite($file, "POST (" + date_format($date, 'Y-m-d H:i:s') + "): " + base64_decode($_POST["logInfo"]) + PHP_EOL + PHP_EOL);
    fflush($file);
    fclose($file);
?>