@extends('layouts.backend.app')

@section('css')
<style>


</style>
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrators</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Admin List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th><i class="fas fa-exclamation"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->type }}</td>
                                    <td>
                                        @if($admin->status == 1)
                                            <span class="badge badge-success" style="cursor: pointer;">Active</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->


@section('js')
<script>


</script>
@endsection
@endsection
