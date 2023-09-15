<?php
$qpo = mysqli_query($db, "SELECT * from listcarton where `status` is null and deliverydate is null and scanstatus='Complete' group by donumber");
$del = mysqli_query($db, "delete from unpack_temp where userid='" . $_SESSION['packnik'] . "'");
?>
<section class="content">
  <div class="container-fluid pt-2">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="far fa-file-alt"></i> Unpack Carton FG</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row d-flex mb-3">
              <form class="row" method="post">
                <div class="col-auto">
                  <label>Season:</label>
                  <select style="width:100%" name="season" class="form-control" id="season" onchange="getpono(this.value)">
                    <?php
                    if (isset($_POST['season'])) { ?>
                      <option><?= $_POST['season'] ?></option>
                    <?php } else {
                      echo '<option></option>';
                    }
                    $qs = mysqli_query($db, "SELECT season from purchase_order group by season order by modified desc");
                    while ($ds = mysqli_fetch_assoc($qs)) {
                      echo '<option>' . $ds['season'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-auto">
                  <label>PO Number:</label>
                  <select style="width:100%" id="pono" name="pono" class="form-control" onchange="getdono(this.value)">
                    <?php
                    if (isset($_POST['pono'])) {
                      $qpon = mysqli_query($db, "SELECT po from purchase_order where idpo='" . $_POST['pono'] . "'");
                      $dpon = mysqli_fetch_assoc($qpon);
                    ?>
                      <option value="<?= $_POST['pono'] ?>"><?= $dpon['po'] ?></option>
                    <?php } else {
                      echo '<option></option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-auto">
                  <label>DO Number:</label>
                  <select style="width:100%" id="dono" class="do form-control" name="dono" onchange="this.form.submit()">
                    <?php
                    if (isset($_POST['dono'])) { ?>
                      <option value="<?= $_POST['dono'] ?>"><?= $_POST['dono'] ?></option>
                    <?php } else {
                      echo '<option></option>';
                    }
                    ?>
                  </select>
                </div>
              </form>
              <?php
              if (isset($_POST['dono'])) {
                $dono = $_POST['dono'];
                $qdo = mysqli_query($db, "select * from listcarton where donumber='$dono' and scanstatus is not null");
                $ddo = mysqli_fetch_assoc($qdo);
                $qpo = mysqli_query($db, "select * from purchase_order where idpo='" . $ddo['idpo'] . "'");
                $dpo = mysqli_fetch_assoc($qpo);
              ?>
                <div class="col-lg-3 divdata">
                  <label>Destination:</label>
                  <input type="text" name="dest" readonly class="form-control" value="<?= $ddo['destination'] ?>">
                </div>
            </div>
            <div class="row d-flex mb-3 divdata">
              <div class="col-lg-3">
                <label>PO Date:</label>
                <input type="text" name="deliv" readonly class="form-control" value="<?= $dpo['deliverydate'] ?>">
              </div>
              <div class="col-lg-2">
                <label>Qty PO:</label>
                <input type="number" readonly class="form-control" value="<?= $dpo['qtypo'] ?>">
              </div>
              <div class="col-lg-2">
                <label>Overship:</label>
                <input type="number" readonly class="form-control" value="<?= $dpo['overship'] ?>">
              </div>
              <div class="col-lg-2">
                <label>Total Qty:</label>
                <input type="number" readonly class="form-control" value="<?= $dpo['total'] ?>">
              </div>
            </div>
            <div class="divdata row d-flex justify-content-center mt-5">
              <button class="btn btn-danger mr-5" data-toggle="modal" data-target="#myModal1"><i class="fal fa-barcode-alt"></i> Unpack Scan</button>
              <div class="modal fade" id="myModal1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Unpack Scan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <form action="unpackscan.php" method="post">
                      <div class="modal-body">
                        <table class="table table-sm">
                          <tr>
                            <td>DO Number</td>
                            <td><input type="text" name="dono" readonly class="form-control" value="<?= $dono ?>"></td>
                            <td>Qty PO</td>
                            <td><input type="number" name="qtypo" readonly class="form-control" value="<?= $dpo['qtypo'] ?>"></td>
                          </tr>
                          <tr>
                            <td>Destination</td>
                            <td><input type="text" name="dest" readonly class="form-control" value="<?= $ddo['destination'] ?>"></td>
                            <td>Overship</td>
                            <td><input type="number" name="overship" readonly class="form-control" value="<?= $dpo['overship'] ?>"></td>
                          </tr>
                          <tr>
                            <td>PO Date</td>
                            <td><input type="date" name="podate" readonly class="form-control" value="<?= $dpo['deliverydate'] ?>"></td>
                            <td>Total</td>
                            <td><input type="number" name="total" readonly class="form-control" value="<?= $dpo['total'] ?>"></td>
                          </tr>
                        </table>
                        <p class="text-center">Login Approval</p>
                        <div class="row d-flex justify-content-center">
                          <div class="col-lg-6">
                            <label>NIK</label>
                            <input type="text" name="nik" required class="form-control">
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-lg-6">
                            <label>Password</label>
                            <input type="password" name="pass" required class="form-control">
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-lg-6">
                            <label>Tgl Lahir</label>
                            <input type="date" name="lahir" required class="form-control">
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-lg-6">
                            <label>Reason Unpack</label>
                            <select class="form-control" required name="reason" id="reason">
                              <option></option>
                              <option>QC Final Inspect</option>
                              <option>QC Buyer Audit</option>
                              <option>QC Internal Inspect</option>
                              <option>Allowance Unpack</option>
                              <option>Packing Unpack</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mr-5">Approve Unpack Scan</button>
                        <button type="button" class="btn btn-danger ml-5" data-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="myModal2">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Unpack Manual</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <form action="tunpackmanual.php" method="post">
                      <div class="modal-body">
                        <table class="table table-sm">
                          <tr>
                            <td>DO Number</td>
                            <td><input type="text" name="dono" readonly class="form-control form-control-sm" value="<?= $dono ?>"></td>
                            <td>Qty PO</td>
                            <td><input type="number" name="qtypo" readonly class="form-control form-control-sm" value="<?= $dpo['qtypo'] ?>"></td>
                          </tr>
                          <tr>
                            <td>Destination</td>
                            <td><input type="text" name="dest" readonly class="form-control form-control-sm" value="<?= $ddo['destination'] ?>"></td>
                            <td>Overship</td>
                            <td><input type="number" name="overship" readonly class="form-control form-control-sm" value="<?= $dpo['overship'] ?>"></td>
                          </tr>
                          <tr>
                            <td>PO Date</td>
                            <td><input type="date" name="podate" readonly class="form-control form-control-sm" value="<?= $dpo['deliverydate'] ?>"></td>
                            <td>Total</td>
                            <td><input type="number" name="total" readonly class="form-control form-control-sm" value="<?= $dpo['total'] ?>"></td>
                          </tr>
                        </table>
                        <p class="text-center">Login Approval</p>
                        <div class="row d-flex justify-content-center">
                          <div class="col-lg-6">
                            <label>NIK</label>
                            <input type="text" name="nik" required class="form-control form-control-sm">
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-lg-6">
                            <label>Password</label>
                            <input type="password" name="pass" required class="form-control form-control-sm">
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-lg-6">
                            <label>Tgl Lahir</label>
                            <input type="date" name="lahir" required class="form-control form-control-sm">
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-lg-6">
                            <label>Reason Unpack</label>
                            <select class="form-control reason" required name="reason">
                              <option></option>
                              <option>QC Final Inspect</option>
                              <option>QC Buyer Audit</option>
                              <option>QC Internal Inspect</option>
                              <option>Allowance Unpack</option>
                              <option>Packing Unpack</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mr-5">Approve Unpack Manual</button>
                        <button type="button" class="btn btn-danger ml-5" data-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <button class="btn btn-danger ml-5 mr-5" data-toggle="modal" data-target="#myModal2"><i class="fal fa-typewriter"></i> Unpack Manual</button>
              <!-- <button class="btn btn-secondary ml-5 px-4">Exit</button> -->

            </div>
          <?php } ?>
          </div>
          <div class="card-footer">
            <!-- Footer -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  function getdono(params) {
    if (params != '') {
      $('#dono').empty();
      $('divdata').fadeOut();
      $.ajax({
        url: 'ajax/getdata.php',
        method: 'post',
        data: {
          idpo: params
        },
        success: function(a) {
          $('#dono').append(a);
        }
      })
    }
  }

  function getpono(params) {
    if (params != '') {
      $('#pono,#dono').empty();
      $('divdata').fadeOut();
      $.ajax({
        url: 'ajax/getdata.php',
        method: 'post',
        data: {
          season: params
        },
        success: function(a) {
          $('#pono').append(a);
        }
      })
    }
  }

  $('select[name=dono]').select2({
    allowClear: true,
    placeholder: 'Select DO Number'
  })
  $('#season').select2({
    allowClear: true,
    placeholder: 'Select Season'
  })
  $('#reason,.reason').select2({
    allowClear: true,
    placeholder: 'Select Season'
  })
  $('#pono').select2({
    allowClear: true,
    placeholder: 'Select PO Number'
  })
</script>