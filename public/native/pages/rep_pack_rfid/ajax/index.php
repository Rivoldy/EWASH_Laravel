<?php
include '../../../proses/conn.php';

$nik = $_SESSION['wnik'];
$tipe = $_POST['tipe'];
$result = array();
if ($tipe == "data") { ?>
    <table id="example" class="table table-sm table-hover table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Packing List</th>
                <th>Style</th>
                <th>KP</th>
                <th>Delivery Date</th>
                <th>Destination</th>
                <th>Actual Pcs</th>
                <th>Actual Bag</th>
                <th>Closing Date</th>
                <th>Truck No</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $now = date('Y-m-d');
            $last = date('Y-m-d', strtotime('-1 months'));
            $q = mysqli_query($conn, "SELECT * FROM pl_send WHERE delivery BETWEEN '$last' AND '$now'");
            while ($r = mysqli_fetch_assoc($q)) {
                $q1 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_bag WHERE pl_id = '{$r['id']}'");
                if (mysqli_num_rows($q1) == 0) {
                    $pcs = 0;
                } else {
                    $r1 = mysqli_fetch_array($q1);
                    $pcs = $r1['qty'] == null ? 0 : $r1['qty'];
                }
                $bag = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM t_bag WHERE pl_id = '{$r['id']}' GROUP BY bid"));

                if ($r['closing'] == null && $_SESSION['wdept'] != "D13") {
                    $edit = "";
                    $del = "";
                    $load = "";
                    $close = "";
                    $unclose = "hidden";
                } else if ($r['closing'] == null && $_SESSION['wdept'] == "D13") {
                    $edit = "";
                    $del = "";
                    $load = "";
                    $close = "";
                    $unclose = "";
                } else if ($r['closing'] != null && $_SESSION['wdept'] != "D13") {
                    $edit = "disabled";
                    $del = "disabled";
                    $load = "disabled";
                    $close = "disabled";
                    $unclose = "hidden disabled";
                } else if ($r['closing'] != null && $_SESSION['wdept'] == "D13") {
                    $edit = "disabled";
                    $del = "disabled";
                    $load = "disabled";
                    $close = "disabled";
                    $unclose = "";
                }
            ?>
                <tr>
                    <td><?= $r['pl'] ?></td>
                    <td><?= $r['style'] ?></td>
                    <td><?= $r['kp'] ?></td>
                    <td><?= $r['delivery'] ?></td>
                    <td><?= $r['dest'] ?></td>
                    <td><?= $pcs ?></td>
                    <td><?= $bag ?></td>
                    <td><?= $r['closing'] ?></td>
                    <td><?= $r['truck'] ?></td>
                    <td align="center">
                        <button class="btn btn-warning mr-2" <?= $edit ?> onclick="edit('<?= $r['id'] ?>')" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" <?= $del ?> onclick="del('<?= $r['id'] ?>')" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn btn-info" <?= $load ?> onclick="loading('<?= $r['id'] ?>')" title="Loading"><i class="fal fa-truck-container"></i></button>
                        <button class="btn btn-danger" <?= $close ?> onclick="closing('<?= $r['id'] ?>')" title="Closing"><i class="fas fa-lock"></i></button>
                        <button class="btn btn-warning mr-2" <?= $unclose ?> onclick="unclose('<?= $r['id'] ?>')" title="Unclosing"><i class="fas fa-unlock"></i></button>
                    </td>
                <?php } ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            var t = $('#example').DataTable({
                scrollY: '65vh',
                scrollCollapse: true,
                paging: false,
                "dom": '<"toolbar">frtip',
                "order": [
                    [1, 'asc']
                ]
            });
            $("div.toolbar").html('<span class="text-right"><button class="btn btn-success" onclick="btnAdd()"><i class="fal fa-plus-circle"></i> Add Packing List</button></span>');
        })
    </script>
<?php } else if ($tipe == "pl") {
    $tahun = date('y');
    $bulan = date('m');
    $q = mysqli_query($conn, "SELECT * FROM pl_send WHERE tahun = '$tahun' AND bulan = '$bulan' ORDER BY pl DESC LIMIT 1");
    if (mysqli_num_rows($q) == 0) {
        $pl = "ESGI/MES/SW/" . $tahun . $bulan . "/001";
    } else {
        $r = mysqli_fetch_array($q);
        $no = "";
        $urut = substr($r['pl'], strlen($r['pl']) - 3) + 1;
        for ($ii = strlen($urut); $ii <= 2; $ii++) {
            $no = $no . "0";
        }
        $no = $no . $urut;
        $pl = "ESGI/MES/SW/" . $tahun . $bulan . "/" . $no;
    }

    echo $pl;
} else if ($tipe == "kp") {
    $style = $_POST['style'];

    echo '<option></option>';
    $q = mysqli_query($conn, "SELECT * FROM t_bag WHERE style='$style' GROUP BY kp");
    while ($r = mysqli_fetch_array($q)) {
        echo '<option value=' . $r['kp'] . '>' . $r['kp'] . '</option>';
    }
} else if ($tipe == "crup") {
    $pl = $_POST['pl'];
    $style = $_POST['style'];
    $kp = $_POST['kp'];
    $delivery = $_POST['delivery'];
    $dest = $_POST['dest'];
    $truck = $_POST['truck'];
    $driver = $_POST['driver'];
    $contact = $_POST['contact'];
    $tahun = date('y');
    $bulan = date('m');
    $nik = $_SESSION['wnik'];

    $s = mysqli_query($conn, "SELECT * FROM pl_send WHERE pl = '$pl'");
    if (mysqli_num_rows($s) == 0) {
        $q = mysqli_query($conn, "INSERT INTO pl_send (tahun, bulan, pl, style, kp, delivery, dest, truck, driver, contact, modified, pic) 
        VALUES ('$tahun', '$bulan', '$pl', '$style', '$kp', '$delivery', '$dest', '$truck', '$driver', '$contact', NOW(), '$nik')");
    } else {
        $q = mysqli_query($conn, "UPDATE pl_send SET truck = '$truck', driver = '$driver', contact = '$contact', modified = NOW(), pic = '$nik' 
        WHERE pl = '$pl'");
    }

    if ($q) {
        echo "success";
    } else {
        echo mysqli_error($conn);
    }
} else if ($tipe == "edit") {
    $id = $_POST['id'];
    $q = mysqli_query($conn, "SELECT * FROM pl_send WHERE id = '$id'");
    $r = mysqli_fetch_array($q);

    array_push($result, array(
        'pl' => $r['pl'],
        'style' => $r['style'],
        'kp' => $r['kp'],
        'delivery' => $r['delivery'],
        'dest' => $r['dest'],
        'truck' => $r['truck'],
        'driver' => $r['driver'],
        'contact' => $r['contact'],
    ));

    $style = array();
    $q1 = mysqli_query($conn, "SELECT * FROM t_bag GROUP BY style");
    while ($r1 = mysqli_fetch_array($q1)) {
        array_push($style, array(
            'style' => $r1['style'],
        ));
    }

    $kp = array();
    $q1 = mysqli_query($conn, "SELECT * FROM t_bag WHERE style = '{$r['style']}' GROUP BY kp");
    while ($r1 = mysqli_fetch_array($q1)) {
        array_push($kp, array(
            'kp' => $r1['kp'],
        ));
    }

    echo json_encode(array('isi' => $result, 'style' => $style, 'kp' => $kp));
} else if ($tipe == "del") {
    $id = $_POST['id'];
    $s = mysqli_query($conn, "SELECT * FROM t_bag WHERE pl_id = '$id'");
    if (mysqli_num_rows($s) == 0) {
        $q = mysqli_query($conn, "DELETE FROM pl_send WHERE id = '$id'");

        if ($q) {
            echo "success";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo "Loading sudah dilakukan";
    }
} else if ($tipe == "datatemp") {
    $pl_id = $_POST['pl_id'];
    $columns = array(
        0 => 'bid',
        1 => 'style',
        2 => 'kp',
        3 => 'qty',
        4 => 'loading',
        5 => 'pic_loading',
    );

    $querycount = mysqli_query($conn, "SELECT * FROM t_bag where pl_id='$pl_id' limit 10");
    $totalFiltered = $totalData = mysqli_num_rows($querycount);
    $query = mysqli_query($conn, "SELECT *, SUM(qty) AS total FROM t_bag where pl_id='$pl_id' GROUP BY bid order by loading desc limit 10");
    $data = array();
    if (!empty($query)) {
        while ($r = $query->fetch_array()) {
            $nestedData['bid'] = $r['bid'];
            $nestedData['style'] = $r['style'];
            $nestedData['kp'] = $r['kp'];
            $nestedData['qty'] = $r['total'];
            $nestedData['loading'] = $r['loading'];
            $nestedData['pic_loading'] = $r['pic_loading'];
            $data[] = $nestedData;
        }
    }

    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );

    echo json_encode($json_data);
} else if ($tipe == "cekloading") {
    $bid = $_POST['bid'];
    $pl_id = $_POST['pl_id'];
    $style = $_POST['style'];
    $kp = $_POST['kp'];
    $q = mysqli_query($conn, "SELECT * FROM t_bag WHERE bid = '$bid' AND style = '$style' AND kp = '$kp'");
    if (mysqli_num_rows($q) == 0) {
        array_push($result, array(
            'notif' => 'not',
        ));
    } else {
        $d = mysqli_fetch_assoc($q);
        if ($d['pl_id'] != null) {
            array_push($result, array(
                'notif' => 'deli',
            ));
        } else {
            $q = mysqli_query($conn, "UPDATE t_bag SET pl_id = '$pl_id', loading = NOW(), pic_loading = '$nik' WHERE bid = '$bid'");
            $q2 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_bag WHERE pl_id = '$pl_id'");
            if (mysqli_num_rows($q2) == 0) {
                $plo = 0;
            } else {
                $r2 = mysqli_fetch_array($q2);
                $plo = $r2['qty'] == null ? 0 : $r2['qty'];
            }
            array_push($result, array(
                'notif' => 'scs',
                'pcs' => $plo,
            ));
        }
    }

    echo json_encode(array('isi' => $result));
} else if ($tipe == "close") {
    $id = $_POST['id'];
    $q = mysqli_query($conn, "UPDATE t_bag SET closing_status = '1', closing = NOW() WHERE pl_id = '$id'");
    $q1 = mysqli_query($conn, "UPDATE pl_send SET closing = NOW(), pic_closing = '$nik' WHERE id = '$id'");
    if ($q && $q1) {
        echo "success";
    } else {
        echo mysqli_error($conn);
    }
} else if ($tipe == "unclose") {
    $id = $_POST['id'];
    $value = $_POST['value'];
    $q = mysqli_query($conn, "UPDATE t_bag SET closing_status = null, closing = null WHERE pl_id = '$id'");
    $q1 = mysqli_query($conn, "UPDATE pl_send SET reason = '$value', closing = null, pic_closing = null WHERE id = '$id'");
    if ($q && $q1) {
        echo "success";
    } else {
        echo mysqli_error($conn);
    }
}
