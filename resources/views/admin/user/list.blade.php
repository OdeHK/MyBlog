@extends('admin.layout.master')

@section('title')
List User
@endsection

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List</small>
                </h1>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{session('success')}}
                </div>
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="odd gradeX" align="center">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->is_admin ? 'x' : ''}}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                    href="{{route('admin.user.edit', $user->id)}}">Edit</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                    href="{{route('admin.user.delete', $user->id)}}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection