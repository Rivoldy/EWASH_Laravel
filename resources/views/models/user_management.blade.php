@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Management</h3> 
                <div class="card-tools">
                    <form action="{{ route('privilegeKlegoSambi.index') }}" method="GET">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Cari...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                &nbsp; &nbsp;
                                <div class="btn-group">
                                  <a class="btn btn-primary btn-sm"
                                      href="#" onclick="openCreateModal('{{ route('privilegeKlegoSambi.create') }}')">
                                      <i class="fal fa-plus-circle"></i> New
                                  </a>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="height: 450px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nik</th>
                            <th>User Name</th>
                            <th>Group Access</th>
                            <th>RFID</th>
                            <th>Active Privilege</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ewash as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->privilege_user_nik }}</td>
                            <td>{{ $value->privilege_user_name }}</td>
                            <td>
                                @foreach ($groupAccessData as $groupAccess)
                                    @if ($groupAccess->group_access_id == $value->privilege_group_access_id)
                                        {{ $groupAccess->group_access_name }}
                                    @endif
                                @endforeach
                            </td>                                                                            
                            <td>{{ $value->privilege_rfid }}</td>
                            <td>{{ $value->privilege_aktif }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-xs"
                                    onclick="openEditModal('{{ route('privilegeKlegoSambi.edit', $value->privilege_id) }}')">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('privilegeKlegoSambi.destroy', $value->privilege_id) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"
                                        onclick="return confirm('Apakah Anda yakin menghapus data?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <ul class="pagination float-right">
                {{-- {{ $tampung->links('pagination::bootstrap-4') }} --}}
            </ul>
        </div>
    </div>
</div>

<!-- Modal Edit  -->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Konten modal akan dimuat melalui JavaScript -->
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-labelledby="createMenuModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Konten modal akan dimuat melalui JavaScript -->
        </div>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal
    function openEditModal(url) {
        $.get(url, function(data) {
            $('#editMenuModal .modal-content').html(data);
            $('#editMenuModal').modal('show');
        });
    }

    // Ketika tombol "Kembali" diklik
    $('#editMenuModal').on('hidden.bs.modal', function () {
        // Mengaktifkan modal kembali saat tombol "Kembali" ditekan
        $('#editMenuModal').modal('show');
    });

    function openCreateModal(url) {
        $.get(url, function(data) {
            $('#createMenuModal .modal-content').html(data);
            $('#createMenuModal').modal('show');
        });
    }
</script>
@endsection
