@extends('layout.master')

@section('content') 
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Menu</h3>
          </div>
        </div>
        <!-- /.card-header --> 
        
        <div class="card-body">
          <form method="POST" action="{{ route('menu.store') }}">
            @csrf
            <div class="form-group">
              <label for="menu_name">Nama</label>
              <input type="text" name="menu_name" class="form-control" id="menu_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>
    
@endsection
