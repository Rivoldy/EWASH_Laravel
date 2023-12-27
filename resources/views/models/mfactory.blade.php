@extends('layout.master')

@section('content') 
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">User Management</h3>
          <div class="card-tools">
          </div>
        </div>
        </div>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 450px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>#</th>
                <th>Factory</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tampung as $item=>$value)
               
              <tr>
                <td>{{$item+1}}</td>
                <td>{{$value->factory}}</td>
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