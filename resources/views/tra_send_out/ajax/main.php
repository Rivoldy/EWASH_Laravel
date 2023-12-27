                   <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Packing List</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="input-group input-group-sm">
                      <input required disabled type="text" id="pl" class="form-control form-control-sm">
                    </div>
                    <br>
                    <label>Style</label>
                    <div class="input-group input-group-sm">
                      <select id="style" style="width: 100%;">
                      </select>
                    </div>
                    <label>KP</label>
                    <div class="input-group input-group-sm">
                      <select style="width: 100%;" id="kp">
                      </select>
                    </div>
                    <label>Delivery Date</label>
                    <div class="input-group input-group-sm">
                      <input required type="date" id="delivery" class="form-control form-control-sm">
                    </div>
                    <label>Destination</label>
                    <div class="input-group input-group-sm">
                      <input required type="text" id="dest" class="form-control form-control-sm">
                    </div>
                    <label>Truck No</label>
                    <div class="input-group input-group-sm">
                      <input required type="text" id="truck" class="form-control form-control-sm">
                    </div>
                    <label>Driver</label>
                    <div class="input-group input-group-sm">
                      <input required type="text" id="driver" class="form-control form-control-sm">
                    </div>
                    <label>Contact Driver</label>
                    <div class="input-group input-group-sm">
                      <input required type="text" id="contact" class="form-control form-control-sm">
                    </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="Save" onclick="Crup();">Save</button>
                    <button type="button" class="btn btn-warning" id="Update" onclick="Crup();">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</section>
<script>
  $(document).ready(function() {
    showrep();
    $('#style').select2({
      placeholder: 'Select Style',
      dropdownParent: $('#modal'),
    })
    $('#kp').select2({
      placeholder: 'Select KP',
      dropdownParent: $('#modal'),
    })
    $('#style').on('change', function() {
      $('#kp').html('');
      $.ajax({
        url: "ajax/index.php",
        type: "POST",
        cache: false,
        data: {
          style: $('#style').val(),
          tipe: "kp",
        },
        success: function(data) {
          $('#kp').append(data)
        }
      })
    })
  });

  function showrep() {
    $("#kontent").html('<h6 class="text-center mt-5"><i class="fad fa-spinner fa-spin text-danger"></i> Please wait! Preparing your data..</h6>');
    $.ajax({
      url: 'ajax/index.php',
      method: 'post',
      data: {
        tipe: "data",
      },
      success: function(a) {
        $("#kontent").html(a).fadeIn();
      }
    })
  }

  function btnAdd() {
    $('#modal').modal('show');
    $('.modal-header').removeClass('bg-warning');
    $('.modal-header').addClass('bg-success');
    $('#Update').attr('hidden', true);
    $('#Save').attr('hidden', false);
    $.ajax({
      url: 'ajax/index.php',
      method: 'post',
      data: {
        tipe: "pl",
      },
      success: function(a) {
        $('#pl').val(a);
        $('#style').val('').trigger('change');
        $('#style').html('<option value=""></option>' +
          <?php
          $q = mysqli_query($conn, "SELECT * FROM t_scale GROUP BY style");
          while ($r = mysqli_fetch_array($q)) { ?> '<option value="<?= $r['style'] ?>"><?= $r['style'] ?></option>' + <?php } ?> '');

        $('#kp').val('').trigger('change');
        $('#delivery').val('');
        $('#dest').val('');
        $('#truck').val('');
        $('#driver').val('');
        $('#contact').val('');

        $('#style').attr('disabled', false);
        $('#kp').attr('disabled', false);
        $('#delivery').attr('disabled', false);
        $('#dest').attr('disabled', false);
      }
    })
  }

  function edit(id) {
    $.ajax({
      url: 'ajax/index.php',
      method: 'post',
      data: {
        id: id,
        tipe: "edit",
      },
      dataType: 'json',
      success: function(a) {
        $('#modal').modal('show');
        $('.modal-header').removeClass('bg-success');
        $('.modal-header').addClass('bg-warning');
        $('#Update').attr('hidden', false);
        $('#Save').attr('hidden', true);

        $('#pl').val(a.isi[0].pl);
        $('#style').val(a.isi[0].style);
        $('#style').html('<option value="' + a.isi[0].style + '">' + a.isi[0].style + '</option>');
        for (var i = 0; i < a.style.length; i++) {
          $('#style').append('<option value="' + a.style[i].style + '">' + a.style[i].style + '</option>');
        }

        $('#kp').val(a.isi[0].kp);
        $('#kp').html('<option value="' + a.isi[0].kp + '">' + a.isi[0].kp + '</option>');
        for (var i = 0; i < a.kp.length; i++) {
          $('#kp').append('<option value="' + a.kp[i].kp + '">' + a.kp[i].kp + '</option>');
        }

        $('#delivery').val(a.isi[0].delivery);
        $('#dest').val(a.isi[0].dest);
        $('#truck').val(a.isi[0].truck);
        $('#driver').val(a.isi[0].driver);
        $('#contact').val(a.isi[0].contact);

        $('#style').attr('disabled', true);
        $('#kp').attr('disabled', true);
        $('#delivery').attr('disabled', true);
        $('#dest').attr('disabled', true);
      },
    })
  }

  function del(id) {
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Process tidak dapat dibatalkan dan hanya dapat dilakukan sebelum Loading?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "ajax/index.php",
          type: "POST",
          cache: false,
          data: {
            id: id,
            tipe: "del",
          }
        }).then((result) => {
          if (result == "success") {
            Swal.fire('Success', 'Delete Successfully', 'success');
            showrep();
          } else {
            Swal.fire('Error', result, 'error');
          }
        })
      }
    })
  }

  function loading(id) {
    window.open("loading.php?i=" + id, "_self")
  }

  function Crup() {
    if ($('#style').val() == "" || $('#kp').val() == "" || $('#delivery').val() == "" || $('#dest').val() == "" || $('#truck').val() == "" ||
      $('#driver').val() == "" || $('#contact').val() == "") {
      Swal.fire('Error', 'Please fill all column', 'error');
    } else {
      var data = new FormData();
      data.append('pl', $('#pl').val());
      data.append('style', $('#style').val());
      data.append('kp', $('#kp').val());
      data.append('delivery', $('#delivery').val());
      data.append('dest', $('#dest').val());
      data.append('truck', $('#truck').val());
      data.append('driver', $('#driver').val());
      data.append('contact', $('#contact').val());
      data.append('tipe', 'crup');
      $.ajax({
        url: "ajax/index.php",
        type: "POST",
        cache: true,
        data: data,
        processData: false,
        contentType: false,
        success: function(data) {
          if (data == "success") {
            $('#modal').modal('hide');
            Swal.fire('Success', 'Data Added Successfully', 'success');
            showrep();
          } else {
            Swal.fire('Error', data, 'error');
          }
        },
      })
    }
  }

  function closing(id) {
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Anda tidak dapat mengubah data packing list setelah dilakukan closing?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Closing it!'
    }).then((result) => {
      if (result.value) {    
        $.ajax({
          url: "ajax/index.php",
          type: "POST",
          cache: false,
          data: {
            id: id,
            tipe: "close",
          }
        }).then((result) => {
          if (result == "success") {
            Swal.fire('Success', 'Closing Successfully', 'success');
            showrep();
          } else {
            Swal.fire('Error', result, 'error');
          }
        })
      }
    })
  }

  function unclose(id) {
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Anda akan unclose",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, unclose it!',
      input: 'text',
      inputLabel: 'Reason',
      inputPlaceholder: 'Masukkan alasannya',
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "ajax/index.php",
          type: "POST",
          cache: false,
          data: {
            value: result.value,
            id: id,
            tipe: 'unclose',
          },
          success: function(data) {
            if (data == "success") {
              Swal.fire('Success', 'UnClosing Successfully', 'success');
              showrep();
            } else {
              Swal.fire('Error', data, 'error');
            }
          }
        })
      }
    })
  }

  function expo(id) {
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, export it!'
    }).then((result) => {
      if (result.value) {
        window.open("report.php?id=" + id, "_blank");
      }
    })
  }
</script>
<style>
  .toolbar {
    float: left;
  }
</style>