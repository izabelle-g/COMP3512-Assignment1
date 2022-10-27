<?php
    /**
     * Converts the duration to a "mm:ss" format.
     */
    function toTime($seconds){
        $min = FLOOR($seconds/60);
        $sec = $seconds%60;

        if($sec < 10)
            echo "$min:0$sec";
        else
            echo "$min:$sec";
    }
?>