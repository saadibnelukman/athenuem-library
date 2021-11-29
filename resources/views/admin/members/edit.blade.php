<form action="{{route('member.update')}}" method="POST" id="edit_form">
    @csrf

    <div class="modal-body">
        <div class="form-group">
            <label for="member_id">Member Id</label>
            <input type="text" value="{{$data->member_id}}" class="form-control"  name="member_id" required>
            <input type="hidden" name="id" value="{{ $data->id }}">
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" value="{{$data->first_name}}" class="form-control"  name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" value="{{$data->last_name}}" class="form-control"  name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{$data->email}}" class="form-control"  name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" value="{{$data->phone}}" class="form-control"  name="phone" required>
        </div>
    </div>
    <div class="modal-footer">
        {{--                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
        <button type="submit" class="btn btn-primary"> Submit</button>
    </div>

</form>

<script>
    $('#edit_form').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
            url:url,
            type:'POST',
            async:false,
            data:request,
            success:function(data){
                toastr.success(data);
                $('#edit_form')[0].reset();
                $('#editModal').modal('hide');
                table.ajax.reload();
            }
        });
    });
</script>
