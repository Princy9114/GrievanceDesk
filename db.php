<?php
    $db = mysqli_connect("localhost","root","","grievancedesk");
    if (mysqli_connect_errno()){
        echo "server not connected" . mysqli_connect_error();
    }
?>
