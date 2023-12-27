@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Group Access</h3>
                <div class="card-tools">
                    <form action="{{ route('GroupAccess.index') }}" method="GET">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Cari...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                &nbsp; &nbsp;
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm" href="#" onclick="openCreateModal('{{ route('GroupAccess.create') }}')">
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
                            <th>Name</th>
                            <th>Privilege</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tampung as $item => $value)
                        <tr>
                            <td>{{ $item + 1 }}</td>
                            <td>{{ $value->group_access_name }}</td>
                            <td>{{ $value->privilegeCount }}</td>
                            <td>
                                <a href="{{ route('GroupAccess.edit2', ['id' => $value->group_access_id]) }}"
                                    class="btn btn-info btn-xs"><i class="fas fa-eye"></i></a>

                                <button class="btn btn-warning btn-xs"
                                    onclick="openEditModal('{{ route('GroupAccess.edit', ['GroupAccess' => $value->group_access_id]) }}')">
                                    <i class="fas fa-edit"></i>
                                </button>

                                @if ($value->privilegeCount == 0)
                                <form action="{{ route('GroupAccess.destroy', $value->group_access_name) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"
                                        onclick="return confirm('Apakah Anda yakin menghapus data?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <ul class="pagination float-right">
                {{ $tampung->links('pagination::bootstrap-4') }}
            </ul>
        </div>
    </div>
</div>

<!-- Modal Edit Group Access -->
<div class="modal fade" id="editGroupAccessModal" tabindex="-1" role="dialog"
    aria-labelledby="editGroupAccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Konten modal akan dimuat melalui JavaScript -->
        </div>
    </div>
</div>

<!-- Modal Tambah Group Access -->
<div class="modal fade" id="createGroupAccessModal" tabindex="-1" role="dialog"
    aria-labelledby="createGroupAccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Konten modal akan dimuat melalui JavaScript -->
        </div>
    </div>
</div>

<script>
    function openEditModal(url) {
        $.get(url, function(data) {
            $('#editGroupAccessModal .modal-content').html(data);
            $('#editGroupAccessModal').modal('show');
        });
    }

    function openCreateModal(url) {
        $.get(url, function(data) {
            $('#createGroupAccessModal .modal-content').html(data);
            $('#createGroupAccessModal').modal('show');
        });
    }
</script>

@endsection
