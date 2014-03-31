<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$cus_control = new CustomersController();
$cus_model = new Customers();
$zone_model = new RZone();

$rs = $cus_model->checkBooker(2820);
$rs2 = $zone_model->getZone(1);

echo 'Hello<br/>';
print_r($rs);
echo '<br/>-----------------------------------------------------<br/>';
print_r($rs2);
echo '<br/>-----------------------------------------------------<br/>';
foreach ($rs as $key => $value) {
    print_r($key);
    echo ' = ' . $value;
    echo '<br/>';
}
echo '-----------------------------------------------------<br/>';

ShowBookingTableDetails($rs['C_seats']);

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

    print_r($tmp1);
    echo '<br/>-----------------------------------------------------<br/>';


    foreach ($tmp1 as $key => $value) {
        if ($key % 2 == 0) {
            //set index
            $i = RZone::model()->getZone($value);
            $i = $i[0]['zone'];
        } else {
            $val[$i][] = $value;
        }
    }
    print_r($val);
    echo '<br/>-----------------------------------------------------<br/>';

    foreach ($val as $key => $value) {
        echo $key . ' หมายเลขโต๊ะ ';
        foreach ($value as $key => $val) {
            echo $val;
            if (array_key_exists($key + 1, $value)) {
                echo ', ';
            }
        }
        echo '<br/>';
    }
}

function ShowBookingTableDetailsInLine($string) {
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
    $result = NULL;
    foreach ($val as $key => $value) {
        if ($result == NULL) {
            $result = $key . ' หมายเลขโต๊ะ ';
        } else {
            $result .= ' ' . $key . ' หมายเลขโต๊ะ ';
        }
        foreach ($value as $key => $val) {
            $result .= $val;
            if (array_key_exists($key + 1, $value)) {
                $result .= ', ';
            }
        }
    }
    return $result;
}

echo '<br/>-----------------------------------------------------<br/>';
print_r(ShowBookingTableDetailsInLine($rs['C_seats']));
echo '<br/>-----------------------------------------------------<br/>';
foreach (Customers::model()->getBooker(0, 0)->getData() as $record){
    print_r($record->C_seats);
    echo '<br/><br/>';
}
echo '<br/>-----------------------------------------------------<br/>';
$datas = Customers::model()->getBooker(0, 0)->getData();
print_r($datas[1]['C_seats']);
echo '<br/>';
echo '<br/>';
echo '<br/>';

