<section class="content text-sm">
  <div class="container-fluid pt-2">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-newspaper text-warning"></i> Master Gramasi</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-auto">
                <label>Season:</label>
                <select id="season" style="width: 100%;">
                  <option></option>
                  <?php
                  $q = mysqli_query($sap, "SELECT distinct(ZSEAS) from ordersap where VKGRP like 'UQ%' and ZSEAS!='' order by crd desc");
                  while ($dt = mysqli_fetch_array($q)) {
                    echo '<option>' . $dt[0] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-auto mt-4">
                <button id="btncari" class="mt-1 btn btn-success"><i class="fal fa-search"></i> Search</button>
              </div>
            </div>
            <div class="mt-2" id="kontent"></div>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $("#btncari").on('click', function() {
    var season = $("#season").val();
    if (season != '') {
      $("#kontent").html('<h6 class="text-center mt-5"><span class="fa-stack text-info"><i class="fas fa-circle fa-stack-2x"></i><i class="far fa-hourglass-half fa-spin fa-stack-1x fa-inverse"></i></span> Please wait! Preparing data...</h6>');
      $.ajax({
        url: 'ajax/data.php',
        method: 'post',
        data: {
          season
        },
        success: function(a) {
          $("#kontent").html(a).fadeIn();
        }
      })
    }
  })
  $(function() {
    $("#season").select2({
      placeholder: 'Select Season'
    })
  })
</script>