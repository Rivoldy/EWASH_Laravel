@extends('layout.master')

@section('content')
    
<section class="content text-sm">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa-regular fa-newspaper text-warning"></i> Unpack</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <button class="btn btn-danger" onclick="btnUnpack('scan')"><i class="fal fa-barcode-alt"></i> Unpack Scan</button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-danger" onclick="btnUnpack('manual')"><i class="fal fa-typewriter"></i> Unpack Manual</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="judul"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Style:</label>
                    <select id="style" class="form-control" style="width: 100%;" onchange="getdata('kpno')">
                        <option></option>
                        @foreach ($styles as $style)
                            <option>{{ $style }}</option>
                        @endforeach
                    </select>
                    <label>KP:</label>
                    <select id="kpno"  class="form-control" style="width: 100%;">
                        <option></option>
                    </select>
                    <br>
                    <p class="text-center">Login Approval</p>
                    <label>NIK</label>
                    <input type="text" id="nik" class="form-control">
                    <label>Password</label>
                    <input type="password" id="pass" class="form-control">
                    <label>Tgl Lahir</label>
                    <input type="date" id="lahir" class="form-control">
                    <label>Reason Unpack</label>
                    <select class="form-control" id="reason">
                        <option></option>
                        <option>Sticker Rusak</option>
                        <option>Sticker Buram</option>
                        <option>Salah Input</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary mr-5" id="btnApprove" onclick="Unpack()"></button>
                    <button type="button" class="btn btn-danger ml-5" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    var tipe = null;

    function btnUnpack(mode) {
        tipe = mode;
        if (mode == 'scan') {
            $('#judul').text('Unpack Scan');
            $('#btnApprove').text('Approve Unpack Scan');
        } else if (mode == 'manual') {
            $('#judul').text('Unpack Manual');
            $('#btnApprove').text('Approve Unpack Manual');
        }

        $('#modal').modal('show');
    }

    function Unpack() {
        if ($('#style').val() == '' || $('#kpno').val() == '' || $('#nik').val() == '' ||
            $('#pass').val() == '' || $('#lahir').val() == '' || $('#reason').val() == '') {
            Swal.fire('Error', 'Please fill all', 'error');
        } else {
            $.ajax({
                url: '{{ asset("native/pages/tra_unpack/ajax/index.php")}}',
                method: 'post',
                data: {
                    tipe: 'oten',
                    nik: $('#nik').val(),
                    pass: $('#pass').val(),
                    lahir: $('#lahir').val(),
                },
                success: function(data) {
                    if (data == 'sukses') {
                        openWindowWithPost("{{ asset('native/pages/tra_unpack/unpack.php')}}", {
                            tipe: tipe,
                            nik: $('#nik').val(),
                            style: $('#style').val(),
                            kp: $('#kpno').val(),
                            reason: $('#reason').val(),
                        });
                    } else {
                        Swal.fire('Error', data, 'error');
                    }
                }
            })
        }
    }

    function openWindowWithPost(url, data) {
        var form = document.createElement("form");
        form.target = "_self";
        form.method = "POST";
        form.action = url;
        form.style.display = "none";

        for (var key in data) {
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            input.value = data[key];
            form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }

    function getdata(id) {
        var style = $("#style").val();

        if (id == 'kpno') {
            $("#kpno").empty();
        }

        $.ajax({
            url: '{{ asset("native/pages/tra_unpack/ajax/getdata.php")}}',
            method: 'post',
            data: {
                style
            },
            success: function(a) {
                $("#" + id).append(a);
            }
        })
    }
    $(function() {
        $("#style").select2({
            allowClear: true,
            placeholder: 'Select Style',
            dropdownParent: $('#modal')
        })
        $("#kpno").select2({
            allowClear: true,
            placeholder: 'Select KP',
            dropdownParent: $('#modal')
        })
        $("#reason").select2({
            allowClear: true,
            placeholder: 'Select Reason',
            dropdownParent: $('#modal')
        })
    });
</script>
@endsection
