<div class="row">
    <div class="col-6">
        <table id="tabsku" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th>Style</th>
                    <th>Size Varian</th>
                    <th>Gramasi Varian</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                <tr>
                    <td>{{ $dt['ZMATGEN'] }}</td>
                    <td>{{ $dt['jmlsize'] }}</td>
                    <td>{{ $dt['gram'] }}</td>
                    <td class="text-center">
                        <a onclick="getgram('{{ $dt['ZMATGEN'] }}')" href="#">
                            <i class="text-primary fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-6" id="subkontent">
        <!-- Content loaded via AJAX -->
    </div>
</div>

<script>
    function getgram(style) {
        $("#subkontent").html('<h6 class="pt-5 mt-5 text-center text-info"><i class="fad fa-spinner fa-spin"></i> Preparing your data..</h6>');
        $.ajax({
            url: "{{ route('gramasi.getGram') }}",
            method: 'post',
            data: {
                style
            },
            success: function(a) {
                setTimeout(() => {
                    $("#subkontent").html(a);
                }, 500);
            }
        });
    }

    $(document).ready(function() {
        $('#tabsku').DataTable({
            scrollY: '55vh',
            scrollCollapse: true,
            paging: false,
        });
    });
</script>


