<?php
$mes = mysqli_connect('192.168.155.109', 'webadmin', '2021masihpakaisql?', 'prodtrack') or die('Unable to Connect');
$ewash = mysqli_connect('192.168.155.109', 'webadmin', '2021masihpakaisql?', 'ewash') or die('Unable to Connect');

date_default_timezone_set('Asia/Jakarta');

$tipe = $_POST['tipe'];
$result = array();
if ($tipe == "clear") {
    $s = 0;
    $rfid = $_POST['rfid'];
    $s1 = mysqli_query($ewash, "SELECT * FROM t_rfid_bag WHERE rfid = '$rfid'");
    if (mysqli_num_rows($s1) > 0) {
        $s += 1;
    }

    $s2 = mysqli_query($mes, "SELECT * FROM t_qc WHERE rfid = '$rfid'");
    if (mysqli_num_rows($s2) > 0) {
        $s += 1;
    }

    if ($s > 1) {
        $q1 = mysqli_query($ewash, "UPDATE t_rfid_bag SET reuse = '0' WHERE rfid = '$rfid' AND reuse = '1'");
        $q2 = mysqli_query($mes, "UPDATE t_qc SET reuse = '0' WHERE rfid = '$rfid' AND reuse = '1'");
    } else {
        $q1 = false;
        $q2 = false;
    }
    if ($q1 && $q2) {
        array_push($result, array(
            'notif' => 'sukses',
        ));
    } else {
        array_push($result, array(
            'notif' => 'RFID NOT FOUND',
        ));
    }

    echo json_encode(array('isi' => $result));
}
