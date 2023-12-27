<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Group Access</h3>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <form id="editGroupAccessForm" action="{{ route('GroupAccess.update', $groupAccess->group_access_name) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="group_access_name">Group Access Name</label>
                    <input type="text" name="group_access_name" value="{{ $groupAccess->group_access_name }}" class="form-control">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var submitBtn = document.getElementById('submitBtn');
        submitBtn.addEventListener('click', function () {
            var confirmation = confirm('Apakah Anda yakin ingin menyimpan perubahan?');
            if (confirmation) {
                $('#submitBtn').prop('disabled', true); // Menonaktifkan tombol saat proses ajax berlangsung
                $.ajax({
                    type: "POST",
                    url: "{{ route('GroupAccess.update', $groupAccess->group_access_name) }}",
                    data: $('#editGroupAccessForm').serialize(),
                    success: function (response) {
                        alert('Perubahan berhasil disimpan');
                        window.location.href = "{{ route('GroupAccess.index') }}";
                    },
                    error: function (xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    },
                    complete: function () {
                        $('#submitBtn').prop('disabled', false); // Mengaktifkan tombol kembali setelah proses ajax selesai
                    }
                });
            }
        });
    });
</script>
