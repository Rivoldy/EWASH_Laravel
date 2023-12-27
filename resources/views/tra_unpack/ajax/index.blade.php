<?php
include '../../../proses/conn.php';
include '../../../encdec/sclass.php';

$nik = $_SESSION['wnik'];
$tipe = $_POST['tipe'];
$result = array();
if ($tipe == "oten") {
    $nik = $_POST['nik'];
    $pass = enc($_POST['pass']);
    $lahir = date('Y-m-d', strtotime($_POST['lahir']));
    $q = mysqli_query($conn, "SELECT * FROM akses WHERE nik = '$nik'");
    if (mysqli_num_rows($q) == 0) {
        echo 'NIK not have permission for Approval Unpack';
    } else {
        $r = mysqli_fetch_array($q);
        if ($r['otentikasi'] == 'True') {
            $q1 = mysqli_query($logs, "SELECT * from users where nik='$nik' and password='$pass' and tgllahir='$lahir'");
            if (mysqli_num_rows($q1) == 0) {
                echo 'User Approval not found';
            } else {
                echo 'sukses';
            }
        } else {
            echo 'NIK not have permission for Approval Unpack';
        }
    }
} else if ($tipe == "cek") {
    $bid = $_POST['bid'];
    $q = mysqli_query($conn, "SELECT * FROM t_scale WHERE bid = '$bid'");
    if (mysqli_num_rows($q) == 0) {
        echo 'Unpack Failed, Bag Number not found';
    } else {
        $r = mysqli_fetch_array($q);
        if ($r['pl_id'] != null || $r['loading'] != null) {
            echo 'Unpack Failed, Bag already Loading';
        } else if ($r['closing_status'] != null || $r['closing'] != null) {
            echo 'Unpack Failed, Bag already Closing';
        } else {
            echo 'sukses';
        }
    }
} else if ($tipe == "unpack") {
    $bid = $_POST['bid'];
    $oten = $_POST['oten'];
    $reason = $_POST['reason'];
    $mode = $_POST['mode'];
    $aa = 0;
    $q = mysqli_query($conn, "SELECT * FROM t_scale WHERE bid = '$bid'");
    while ($r = mysqli_fetch_array($q)) {
        $style = $r['style'];
        $kp = $r['kp'];
        $color = $r['color'];
        $size = $r['size'];
        $qty = $r['qty'];
        $gramasi = $r['gramasi'];
        $gw = $r['gw'];
        $nw = $r['nw'];
        $tolerance = $r['tolerance'];
        $empty = $r['empty'];
        $pl_id = $r['pl_id'];
        $loading = $r['loading'];
        $pic_loading = $r['pic_loading'];
        $closing_status = $r['closing_status'];
        $closing = $r['closing'];
        $q1 = mysqli_query($conn, "INSERT INTO t_unpack (bid, style, kp, color, size, qty, gramasi, gw, nw, tolerance, empty, pl_id, loading, pic_loading, closing_status, 
        closing, mode, unpack, reason, modified, pic) 
        VALUES ('$bid', '$style', '$kp', '$color', '$size', '$qty', '$gramasi', '$gw', '$nw', '$tolerance', '$empty', '$pl_id', '$loading', '$pic_loading', 
        '$closing_status', '$closing', '$mode', '$oten', '$reason', NOW(), '$nik')");
        if ($q1) {
            $q2 = mysqli_query($conn, "DELETE FROM t_scale WHERE bid = '$bid' AND style = '$style' AND kp = '$kp' AND color = '$color' AND size = '$size' 
            AND qty = '$qty'");
            if ($q2) {
                $aa++;
            }
        }
    }

    if ($aa == mysqli_num_rows($q)) {
        $q1 = mysqli_query($conn, "SELECT * FROM t_unpack WHERE bid = '$bid'");
        $r1 = mysqli_fetch_array($q1);
?>
        <tr>
            <td><?= $bid ?></td>
            <td><?= $r1['style'] ?></td>
            <td><?= $r1['kp'] ?></td>
            <td><?= mysqli_num_rows($q1) ?></td>
            <td><?= $r1['modified'] ?></td>
            <td><?= $r1['pic'] ?></td>
        </tr>
<?php }
} ?>