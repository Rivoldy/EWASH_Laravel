<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Menu</h3>
            </div>
        </div>
            <!-- /.card-header --> 
            
            <div class="card-body">
                <form id="editMenuForm" action="{{ route('menu.update', $menu->menu_name) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="menu_name">Menu Name</label>
                        <input type="text" name="menu_name" value="{{ $menu->menu_name }}" class="form-control">
                    </div>
                    <!-- Tambahkan kolom lain sesuai dengan tabel Anda -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="submitBtn"> <i class="fas fa-save"></i> Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function () {
        var submitBtn = document.getElementById('submitBtn');
        submitBtn.addEventListener('click', function () {
            var confirmation = confirm('Apakah Anda yakin ingin menyimpan perubahan?');
            if (confirmation) {

                $.ajax({
                    type: "POST",
                    url: "{{ route('menu.update', $menu->menu_name) }}",
                    data: $('#editMenuForm').serialize(),
                    success: function (response) {
                        alert('Perubahan berhasil disimpan');
                        
                        window.location.href = "{{ route('menu.index') }}";
                    },
                    error: function (xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            }
        });
    });
</script>

