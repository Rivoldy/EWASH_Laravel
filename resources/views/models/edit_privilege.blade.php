@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Privilege</h3>
                <a href="{{ route('GroupAccess.index') }}" class="btn btn-sm btn-secondary float-right">Back</a>
            </div>
            <div class="card-body table-responsive p-0" style="height: 450px;">
                <form id="updateForm">
                    @csrf
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check">
                                        <input type="checkbox" id="selectAll" />&nbsp; &nbsp;
                                        <label class="form-check-label" for="selectAll">Select All</label>
                                    </div>
                                </th>
                                <th scope="col">Menu</th>
                                <th scope="col">Privilege</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $item)
                            @foreach ($item->roleAccess->where('role_access_group_access_id', $id) as $prv)
                                <tr>
                                    <td id="chk">
                                        <div>
                                            <input type="hidden" name="check_privilege[{{$prv->role_access_id}}]" value="0">
                                            <input type="checkbox" name="check_privilege[{{$prv->role_access_id}}]" value="1" class="select-checkbox" @if ($prv->selected == 1) checked @endif>
                                        </div>
                                    </td>
                                    <td scope="row">{{$item->menu_name}}</td>
                                    <td>
                                        <select class="form-control" name="role_access[{{$prv->role_access_id}}]">
                                            <option value="1" {{ $prv->role_access == 1 ? 'selected' : '' }}>full</option>
                                            <option value="2" {{ $prv->role_access == 2 ? 'selected' : '' }}>read</option>
                                            <option value="3" {{ $prv->role_access == 3 ? 'selected' : '' }}>update</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success" id="updateButton">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const updateButton = document.getElementById('updateButton');
        updateButton.addEventListener('click', function () {
            const formData = new FormData(document.getElementById('updateForm'));

            fetch('{{ route("GroupAccess.updateBatch", ["id" => $id]) }}', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                }); 
                });

                // Select All functionality
                $('#selectAll').on('change', function () {
                    $('.select-checkbox').prop('checked', $(this).prop('checked'));
             });

                // Update Select All state based on the checkboxes
                $('.select-checkbox').on('change', function () {
                    $('#selectAll').prop('checked', $('.select-checkbox:checked').length === $('.select-checkbox').length);
         });

    });
</script>

@endsection
