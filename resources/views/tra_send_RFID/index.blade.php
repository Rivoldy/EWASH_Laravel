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
                <!-- DataTables Structure -->
                <div class="dataTables_scrollBody" style="position: relative; overflow: auto; max-height: 65vh; width: 100%;">
                    <table id="example" class="table table-sm table-hover table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
                        <!-- Table header -->
                        <thead>
                            <tr role="row">
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
                        <!-- Table body -->
                        <tbody>
                            <tr class="odd">
                                <td>ESGI/MES/SW/2312/001</td>
                                <td>122F022C</td>
                                <td>UQF4000966</td>
                                <td>2023-12-14</td>
                                <td>semarang</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>AD 1092 IT</td>
                                <td align="center">
                                    <button class="btn btn-warning mr-2" onclick="edit('1839')" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" onclick="del('1839')" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    <button class="btn btn-info" onclick="loading('1839')" title="Loading"><i class="fal fa-truck-container"></i></button>
                                    <button class="btn btn-danger" onclick="closing('1839')" title="Closing"><i class="fas fa-lock"></i></button>
                                    <button class="btn btn-warning mr-2" onclick="unclose('1839')" title="Unclosing"><i class="fas fa-unlock"></i></button>
                                    <button class="btn btn-success" disabled="" onclick="expo('1839')" title="Export"><i class="fas fa-file-excel"></i></button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
            </div>
            <script>
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
        <div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-success">
                        <h4 class="modal-title" id="modalLabel">Packing List</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="packingForm">
                            <div class="form-group">
                                <label for="pl">Packing List</label>
                                <input required="" disabled="" type="text" id="pl" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <label for="style">Style</label>
                                <select id="style" style="width: 100%;" class="form-control form-control-sm">
                                    <option value="122F022C">122F022C</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kp">KP</label>
                                <select id="kp" style="width: 100%;" class="form-control form-control-sm">
                                    <!-- Add options for KP -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="delivery">Delivery Date</label>
                                <input required="" type="date" id="delivery" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <label for="dest">Destination</label>
                                <input required="" type="text" id="dest" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <label for="truck">Truck No</label>
                                <input required="" type="text" id="truck" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <label for="driver">Driver</label>
                                <input required="" type="text" id="driver" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <label for="contact">Contact Driver</label>
                                <input required="" type="text" id="contact" class="form-control form-control-sm">
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="Save" onclick="Crup();">Save</button>
                        <button type="button" class="btn btn-warning" id="Update" onclick="Crup();" hidden="hidden">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <!-- Footer content, if any -->
    </div>
</div>

<script>
    function btnAdd() {
        // Handle the logic for opening the modal here
        $('#modal').modal('show');
    }

    function Crup() {
        // Handle the logic for saving/updating data here
        // You can use the values from the modal inputs: $('#pl').val(), $('#style').val(), etc.
        // After processing, you may want to close the modal: $('#modal').modal('hide');
    }
</script>
@endsection
