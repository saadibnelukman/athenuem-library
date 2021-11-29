@extends('layouts.dashboard')
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Return Book</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Return Book</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Return a Book</h3>

                    </div>
                    <!-- /.card-header -->
                    <form method="post" action="{{route('book.return.store')}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select a Book</label>
                                        <select class="form-control select2bs4" style="width: 100%;" name="issued_book_id" required>
                                            @foreach($data as $row)
                                                <option value="{{$row->id}}">Member: {{$row->member->first_name}} - Book: {{$row->book->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- /.col -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label></label>
                                        <button type="submit" class="btn btn-block btn-success">Return</button>
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
