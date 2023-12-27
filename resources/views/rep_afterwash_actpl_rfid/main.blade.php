@extends('layout.master') 

@section('content')
<section class="content text-sm">
  <div class="container-fluid pt-2">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fa-regular fa-newspaper text-success"></i> Report Loaded PackingList</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-auto">
                <label>Style:</label>
                <select id="style"class="form-control" style="width: 100%;" onchange="getdata('kpno')">
                  <option></option>
                  @foreach($styles as $style)
                    <option>{{ $style }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-auto">
                <label>KP:</label>
                <select id="kpno"class="form-control" style="width: 100%;" onchange="getdata('tgl')">
                  <option></option>
                </select>
              </div>
              <div class="col-auto">
                <label>Tanggal:</label>
                <select id="tgl" class="form-control" style="width: 100%;">
                  <option></option>
                </select>
              </div>
              <div class="col-auto mt-4">
                <button onclick="showrep()" class="btn btn-success mt-1"><i class="fal fa-search"></i> Find</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
  function showrep() {
    var kp = $("#kpno").val();
    var tgl = $("#tgl").val();
    if (kp != '' && tgl != '') {
      $("#kontent").html('<h6 class="text-center mt-5"><i class="fad fa-spinner fa-spin text-danger"></i> Please wait! Preparing your data..</h6>');
      $.ajax({
        // url: '{{ asset("native/pages/rep_afterwash_actpl_rfid/ajax/datarep.php") }}',
        method: 'post',
        data: {
          kp,
          tgl
        },
        success: function(a) {
          $("#kontent").html(a).fadeIn();
        }
      })
    }
  }

  function getdata(id) {
    var style = $("#style").val();
    var kp = $("#kpno").val();

    if (id == 'kpno') {
      $("#kpno,#tgl").empty();
    } else {
      $("#tgl").empty();
    }
    $.ajax({
      // url: '{{ asset("native/pages/rep_afterwash_actpl_rfid/ajax/getdata.php") }}',
      method: 'post',
      data: {
        style,
        kp
      },
      success: function(a) {
        $("#" + id).append(a);
      }
    })
  }
  $(function() {
    $("#style").select2({
      placeholder: 'Select Style'
    })
    $("#kpno").select2({
      placeholder: 'Select KP'
    })
    $("#tgl").select2({
      placeholder: 'Select Tanggal'
    })
  });
</script>
@endsection
