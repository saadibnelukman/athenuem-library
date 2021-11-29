@extends('layouts.dashboard')
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Issue Book</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Issue Book</li>
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
                        <h3 class="card-title">Issue a Book</h3>

                    </div>
                    <!-- /.card-header -->
                    <form method="post" action="{{route('store.issued.book')}}">
                        @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select a Member</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="member_id" required>
                                        @foreach($members as $row)
                                        <option value="{{$row->id}}">{{$row->member_id}} - {{$row->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select a Book</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="book_id" required>
                                        @foreach($books as $row)
                                        <option value="{{$row->id}}">{{$row->title}} - {{$row->author}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Returning Date:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" class="form-control"  name="returning_date" required/>

                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label></label>
                                    <button type="submit" class="btn btn-block btn-success">Issue</button>
                                </div>
                                <!-- /.form-group -->

                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>

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
