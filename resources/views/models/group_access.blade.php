@extends('layout.master')

@section('content') 
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div id="button">
            <span style="float: right">
              <a class="btn btn-success" href="{{route ('GroupAccess.create')}}"><i class="fa fa-plus"></i> New</a>
            </div>
          <h3 class="card-title">Group Access</h3>
        </div>

        <!-- /.card-header --> 
        
        <div class="card-body table-responsive p-0" style="height: 450px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Privilege</th>
                <th>Action</th>
              </tr>
              
            </thead>
            <tbody>
              @foreach ($tampung as $item)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->group_access_id }}</td>
                  <td>{{ $item->group_access_name }}</td>
                  <td>
                    <a href="{{ route('PreGroupAccess.edit', ['PreGroupAccess' => $item->group_access_id]) }}"> <i class="fas fa-eye"></i></a>

                    <a href="{{ route('GroupAccess.edit', ['GroupAccess' => $item->group_access_name]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                    <form action="{{ route('GroupAccess.destroy', $item->group_access_name) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data?')">
                          <i class="fa fa-trash"></i>
                      </button>
                  </form>
                  </td>
              </tr>
              @endforeach              
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
    
@endsection