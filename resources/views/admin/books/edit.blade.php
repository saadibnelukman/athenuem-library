<form action="{{route('book.update')}}" method="POST" id="edit_form">
    @csrf

    <div class="modal-body">
        <div class="form-group">
            <label for="book_id">Book Id</label>
            <input type="text" value="{{$data->book_id}}" class="form-control"  name="book_id" required>
            <input type="hidden" name="id" value="{{ $data->id }}">
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" value="{{$data->title}}" class="form-control"  name="title" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" value="{{$data->author}}" class="form-control"  name="author" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control"  name="description">{{$data->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="number_of_copies">Number of Copies</label>
            <input type="text" value="{{$data->number_of_copies}}" class="form-control"  name="number_of_copies" required>
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

