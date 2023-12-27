@extends('layout.master')

@section('content')

<section class="content text-sm">
    <div class="container-fluid pt-2">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa-regular fa-newspaper text-success"></i> Clear RFID</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-auto">
                  <input class="form-control" type="text" name="cartonid" autocomplete="off" autofocus onblur="$(this).focus()">
                  <style>
                    input:focus {
                      outline: #ffffff none !important;
                      box-shadow: 0 0 10px #ffffff;
                    }
                  </style>
                  <h4 id="status"></h4>
                </div>
              </div>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    $(document).ready(function() {
      $('input[name=cartonid]').on('keypress', function(e) {
        if (e.which == 13) {
          var rfid = $(this).val();
          $.ajax({
            url: '{{ asset("native/pages/admin_clear_rfid/ajax/index.php") }}',
            method: 'post',
            data: {
              rfid: rfid,
              tipe: 'clear',
            },
            dataType: 'json',
            success: function(a) {
              if (a.isi[0].notif == 'sukses') {
                $('#status').removeClass('text-danger');
                $('#status').addClass('text-success');
                $("#status").html('SUKSES');
              } else {
                $('#status').addClass('text-danger');
                $('#status').removeClass('text-success');
                $("#status").html(a.isi[0].notif);
              }
              $('input[name=cartonid]').val('');
            }
          })
        }
      })
    });
  </script>

@endsection