@extends('layout.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-newspaper text-warning"></i> Send Out</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="mt-2" id="kontent">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="toolbar">
                    <span class="text-right">
                        <button class="btn btn-success" onclick="btnAdd()">
                            <i class="fal fa-plus-circle"></i> Add Packing List
                        </button>
                    </span>
                </div>
                <!-- Rest of your HTML for DataTables -->
            </div>
            <script>
                // Your DataTables initialization script
                $(document).ready(function () {
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
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" data-backdrop="static" style="display: none;" aria-hidden="true">
            <!-- Modal body -->
            <div class="modal-body">
              <div class="input-group input-group-sm">
                <input required="" disabled="" type="text" id="pl" class="form-control form-control-sm">
              </div>
              <br>
              <label>Style</label>
              <div class="input-group input-group-sm">
                <select id="style" style="width: 100%;" data-select2-id="style" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true"><option value="" data-select2-id="3"></option><option value="122F022C">122F022C</option><option value="122N073A">122N073A</option><option value="123H010D">123H010D</option><option value="123H013C">123H013C</option><option value="123H024C">123H024C</option><option value="123N011D">123N011D</option><option value="222F141B">222F141B</option><option value="222N128A">222N128A</option><option value="223N019B">223N019B</option><option value="223N019E">223N019E</option><option value="223N019H">223N019H</option><option value="223N025A">223N025A</option><option value="223N029B">223N029B</option><option value="223N078A">223N078A</option><option value="223N078B">223N078B</option><option value="223N078C">223N078C</option><option value="223N097A">223N097A</option><option value="223N097B">223N097B</option><option value="223N097C">223N097C</option><option value="223N098A">223N098A</option><option value="223N098B">223N098B</option><option value="223N098C">223N098C</option><option value="223N099A">223N099A</option><option value="223N099B">223N099B</option><option value="223N102A">223N102A</option><option value="322F012A">322F012A</option><option value="322F020D">322F020D</option><option value="322F042A">322F042A</option><option value="322F060D">322F060D</option><option value="322H014A">322H014A</option><option value="322N002B">322N002B</option><option value="322N079A">322N079A</option><option value="323F012A">323F012A</option><option value="323F020D">323F020D</option><option value="323H012A">323H012A</option><option value="323H013B">323H013B</option><option value="323H015C">323H015C</option><option value="323H020D">323H020D</option><option value="323H020E">323H020E</option><option value="323H039E">323H039E</option><option value="323N001B">323N001B</option><option value="823N181A">823N181A</option></select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-style-container"><span class="select2-selection__rendered" id="select2-style-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select Style</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </div>
              <label>KP</label>
              <div class="input-group input-group-sm">
                <select style="width: 100%;" id="kp" data-select2-id="kp" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true"><option data-select2-id="4"></option></select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kp-container"><span class="select2-selection__rendered" id="select2-kp-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select KP</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
              </div>
              <label>Delivery Date</label>
              <div class="input-group input-group-sm">
                <input required="" type="date" id="delivery" class="form-control form-control-sm">
              </div>
              <label>Destination</label>
              <div class="input-group input-group-sm">
                <input required="" type="text" id="dest" class="form-control form-control-sm">
              </div>
              <label>Truck No</label>
              <div class="input-group input-group-sm">
                <input required="" type="text" id="truck" class="form-control form-control-sm">
              </div>
              <label>Driver</label>
              <div class="input-group input-group-sm">
                <input required="" type="text" id="driver" class="form-control form-control-sm">
              </div>
              <label>Contact Driver</label>
              <div class="input-group input-group-sm">
                <input required="" type="text" id="contact" class="form-control form-control-sm">
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="Save" onclick="Crup();">Save</button>
              <button type="button" class="btn btn-warning" id="Update" onclick="Crup();" hidden="hidden">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <!-- Footer content, if any -->
    </div>
</div>
@endsection
