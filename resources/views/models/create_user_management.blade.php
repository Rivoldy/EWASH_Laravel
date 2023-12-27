 <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add User Management</h3>
          </div>
        </div>
        <!-- /.card-header --> 
        
        <div class="card-body">
          <div class="card-body table-responsive p-0" style="height: 500px;">

          <form method="POST" action="{{ route('privilegeKlegoSambi.store') }}">
            @csrf
              <div class="form-group">
                <label>NIK</label>
                <input type="number" class="form-control" name="privilege_user_nik" placeholder="Enter NIK">
              </div>
              @error('privilege_user_nik')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="privilege_user_name" placeholder="Enter Name">
              </div>
              @error('privilege_user_name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          
              <div class="form-group">
                <label>Group Access</label>
               <select name="privilege_group_access_id" class="form-control" id="">
                <option value="">-- pilih group access --</option>
                @forelse ($group as $item)
                    <option value="{{$item->group_access_id}}">{{$item->group_access_name}}</option>
                @empty
                    <option value="">Tidak ada data</option>
                @endforelse
               </select>
              </div>
              @error('group_access_name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          
              <div class="form-group">
                <label>RFID</label>
                <input type="number" class="form-control" name="privilege_rfid" placeholder="Enter RFID">
              </div>
              @error('privilege_rfid')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
          
              <div class="form-group">
                <label>Active Privilage</label>
               <select name="privilege_aktif" class="form-control" id="">
                <option value="">-- pilih active privilage --</option>
                <option value="Y">Y</option>
                <option value="N">N</option>
               </select>
              </div>
              @error('privilege_aktif')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror          
            

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Add</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
          
           
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>
