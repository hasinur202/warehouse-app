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
            <h1>Admin Page</h1>
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
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $admin->type }}</td>
                                    <td>
                                        @if($admin->status == 1)
                                            <span onclick="changeActivity({{ $admin->id }})" class="badge badge-success" style="cursor: pointer;">Active</span>
                                        @else
                                            <span onclick="changeActivity({{ $admin->id }})" class="badge badge-warning" style="cursor: pointer">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-dark btn-xs"><i class="fas fa-edit"></i></a>
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

    function changeActivity(id){
        $.ajax({
            url:"{{ route('admin.activity') }}",
            method:"POST",
            dataType:"json",
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            success: function(response) {
                Toast.fire({
                    icon: 'success',
                    title: 'Status Changes Successfully.'
                })
                window.location.reload();
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Wrong'
                })
            }
        })
    }

</script>
@endsection
@endsection
