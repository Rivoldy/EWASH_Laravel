@extends('layout.master')

@section('content') 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Group Access</h3>
            </div>
            <!-- /.card-header --> 
            
            <div class="card-body">
                <form action="{{ route('GroupAccess.update', $groupAccess->group_access_name) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="group_access_name">Nama Group Access</label>
                        <input type="text" name="group_access_name" value="{{ $groupAccess->group_access_name }}" class="form-control">
                    </div>
                    <!-- Tambahkan kolom lain sesuai dengan tabel Anda -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
    
@endsection
