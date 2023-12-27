@extends('layout.master')

@section('content') 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Menu</h3>
            </div>
            <!-- /.card-header --> 
            
            <div class="card-body">
                <form action="{{ route('menu.update', $menu->menu_name) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="menu_name">Nama Menu</label>
                        <input type="text" name="menu_name" value="{{ $menu->menu_name }}" class="form-control">
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
