@extends('layouts.app')

@section('content')
<section class="content text-sm">
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-newspaper text-warning"></i> Gramasi Details</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5>Style: {{ $style }}</h5>
                                <table class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Gramasi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($gramasiData as $data)
                                            <tr>
                                                <td>{{ $data->nmsize }}</td>
                                                <td>
                                                    <input class="inputgram form-control form-control-sm"
                                                           type="number" step="0.01" value="{{ $data->gram }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-around mt-4">
                            <button onclick="undogram()" class="btn btn-danger"><i class="far fa-undo"></i> Undo</button>
                            <button onclick="savegram()" class="btn btn-primary"><i class="far fa-save"></i> Save Data</button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>

<script>
    function savegram() {
        if (confirm('Are you sure you want to save the data?')) {
            var style = '{{$style}}';
            var nmsize = [];
            var gram = [];

            $(".nmsize").each(function () {
                nmsize.push($(this).val());
            });

            $(".inputgram").each(function () {
                gram.push($(this).val());
            });

            $.ajax({
                url: '{{ route('gramasi.savegram') }}',
                method: 'post',
                data: {
                    style: style,
                    nmsize: nmsize,
                    gram: gram
                },
                success: function (a) {
                    if (a === 'scs') {
                        alert('Data saved successfully');
                    } else {
                        alert('Failed: ' + a);
                    }
                }
            });
        }
    }

    function undogram() {
        if (confirm('Changes will be discarded. Are you sure?')) {

        }
    }

    $(document).ready(function () {
        $('#tabsgram').DataTable({
            dom: '<"toolbar">frtip',
            scrollY: '55vh',
            scrollCollapse: true,
            paging: false,
        });

        $('div.toolbar').html('<h4 class="text-primary">Gramasi Details: {{$style}}</h4>');
    });
</script>
</div>

<style>
    .toolbar {
        float: left;
    }
</style>
@endsection
