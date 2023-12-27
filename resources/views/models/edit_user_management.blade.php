<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit User Management</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <form action="{{ route('privilegeKlegoSambi.update', $edit->privilege_id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="privilege_user_nik">NIK</label>
                                <input type="number" class="form-control" id="privilege_user_nik"
                                    name="privilege_user_nik" placeholder="Enter NIK"
                                    value="{{ old('privilege_user_nik', $edit->privilege_user_nik) }}">
                                @error('privilege_user_nik')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="privilege_user_name">Name</label>
                                <input type="text" class="form-control" id="privilege_user_name"
                                    name="privilege_user_name" placeholder="Enter Name"
                                    value="{{ old('privilege_user_name', $edit->privilege_user_name) }}">
                                @error('privilege_user_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Group Access</label>
                               <select name="privilege_group_access_id" class="form-control" id="">
                                <option value="">-- pilih kategori --</option>
                                @forelse ($group as $item)
                                @if ($item->group_access_id == $edit->privilege_group_access_id)
                                <option value="{{$item->group_access_id}}" selected>{{$item->group_access_name}}</option>
                                @else
                                <option value="{{$item->group_access_id}}">{{$item->group_access_name}}</option>
                                @endif
                                    
                                @empty
                                    <option value="">Tidak ada data</option>
                                @endforelse
                               </select>
                              </div>
                              @error('privilege_group_access_id')
                              <div class="alert alert-danger">{{ $message }}</div>
                              @enderror             

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="privilege_rfid">RFID</label>
                                <input type="number" class="form-control" id="privilege_rfid" name="privilege_rfid"
                                    placeholder="Enter RFID" value="{{ old('privilege_rfid', $edit->privilege_rfid) }}">
                                @error('privilege_rfid')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="privilege_aktif">Active Privilege</label>
                                <select name="privilege_aktif" class="form-control" id="privilege_aktif">
                                    <option value="">-- Select active privilege --</option>
                                    <option value="Y"
                                        {{ old('privilege_aktif', $edit->privilege_aktif) == 'Y' ? 'selected' : '' }}>
                                        Y</option>
                                    <option value="N"
                                        {{ old('privilege_aktif', $edit->privilege_aktif) == 'N' ? 'selected' : '' }}>
                                        N</option>
                                </select>
                                @error('privilege_aktif')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
