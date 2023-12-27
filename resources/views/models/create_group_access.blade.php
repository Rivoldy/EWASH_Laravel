 <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Group Access</h3>
          </div>
        </div>
        <!-- /.card-header --> 
        
        <div class="card-body">
          <form method="POST" action="{{ route('GroupAccess.store') }}">
            @csrf
            <div class="form-group">
              <label for="group_access_name">Name</label>
              <input type="text" name="group_access_name" class="form-control" id="group_access_name" required>
            </div>
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
