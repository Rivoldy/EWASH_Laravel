@extends('layout.master')

@section('title', 'Report Per PackingList')

@section('content')
<section class="content text-sm">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa-regular fa-newspaper text-success"></i> Report Per PackingList</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <label>Packing List:</label>
                                <select class="form-control" id="packlist">
                                    <option></option>
                                    @foreach($pl_send as $pl)
                                    <option value="{{ $pl->id }}">{{ $pl->pl }}</option>
                                    @endforeach
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
        var pl_id = $("#packlist").val();
        if (pl_id != '') {
            $("#kontent").html('<h6 class="text-center mt-5"><i class="fad fa-spinner fa-spin text-danger"></i> Please wait! Preparing your data..</h6>');
            $.ajax({
                url: '{{ asset("native/pages/rep_packlist/ajax/datarep.php") }}',
                method: 'post',
                data: {
                    pl_id,
                },
                success: function(a) {
                    $("#kontent").html(a).fadeIn();
                }
            })
        }
    }

    $(function() {
        $("#packlist").select2({
            placeholder: 'Select Packing List',
            width: '100%',
        })
    });
</script>
@endsection
