@extends('layouts.dashboard')

@section('admin_content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Issued Book List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"> + Add New </button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Issued Book list here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Member Name</th>
                                        <th>Book Title</th>
                                        <th>Issuing Date</th>
                                        <th>Returning Date</th>
                                        <th>Issued By</th>
                                        <th>Return Status</th>


                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $key=>$row)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$row->member->first_name}}</td>
                                            <td>{{$row->book->title}}</td>
                                            <td>{{$row->issuing_date}}</td>
                                            <td>{{$row->returning_date}}</td>
                                            <td>{{$row->user->name}}</td>
                                            <td>
                                                @if($row->return_status==0)
                                                    <span class="badge badge-danger">Not Returned Yet</span>
                                                    @else
                                                    <span class="badge badge-success">Returned</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Member Name</th>
                                        <th>Book Title</th>
                                        <th>Issuing Date</th>
                                        <th>Returning Date</th>
                                        <th>Issued By</th>
                                        <th>Return Status</th>


                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>




@endsection
