<?php

function ShowBookingTableDetails($string) {
    $token = strtok($string, ",");
    while ($token != false) {
        $tmp[] = $token;
        $token = strtok(",");
    }
    foreach ($tmp as $value) {
        $token = strtok($value, "-");
        while ($token != false) {
            $tmp1[] = $token;
            $token = strtok("-");
        }
    }
    foreach ($tmp1 as $key => $value) {
        if ($key % 2 == 0) {
            //set index
            $i = RZone::model()->getZone($value);
            $i = $i[0]['zone'];
        } else {
            $val[$i][] = $value;
        }
    }

    foreach ($val as $key1 => $value1) {
        echo $key1 . ' หมายเลขโต๊ะ ';
        foreach ($value1 as $key2 => $value2) {
            echo $value2;
            if (array_key_exists($key2 + 1, $value1)) {
                echo ', ';
            }
        }
        echo '<br/>';
    }
}
