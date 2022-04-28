<?php
    // Remove http://
    $input = "https://way2tutorial.com";
    $input = preg_replace( "#^[^:/.]*[:/]+#i", "", $input );

    /* Output way2tutorial.com */
    echo $input;
?>