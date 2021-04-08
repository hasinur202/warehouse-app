@extends('layouts.backend.app')

@section('css')
<style>


</style>
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @include('layouts.backend.include.message')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Staffs</h1>
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
                            <h3 class="card-title">Staff List</h3>
                            <button data-toggle="modal" data-target="#addModal" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add New Staff</button>
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
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->address }}</td>
                                    <td>{{ $admin->type }}</td>
                                    <td>
                                        @if($admin->status == 1)
                                            <button onclick="changeActivity({{ $admin->id }})" type="button" class="btn btn-success btn-block btn-xs">Active</button>
                                        @else
                                            <button onclick="changeActivity({{ $admin->id }})" type="button" class="btn btn-danger btn-block btn-xs">Inactive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editModal({{ $admin }})" class="btn btn-dark btn-xs"><i class="fas fa-edit"></i></a>
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
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Staff</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('create.admin') }}" method="POST">
                        @csrf
                        <div class="modal-body col-md-10" style="margin: auto">
                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">First Name</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="first_name" class="form-control" placeholder="First name*" required>
                                </div>
                            </div>
                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">Last Name</span></label>
                                <div class="col-sm-8">
                                  <input type="text" name="last_name" class="form-control" placeholder="Last name*" required>
                                </div>
                            </div>
                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">Phone</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone*" required>
                                </div>
                            </div>
                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">Address</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="address" class="form-control" placeholder="Address*" required>
                                </div>
                            </div>
                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">Staff Type </span></label>
                                <div class="col-sm-8">
                                    <select name="type" class="form-control" required>
                                        <option selected hidden>Select type</option>
                                        <option value="super_admin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">Email </span></label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" placeholder="Email*" required>
                                </div>
                            </div>
                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">Password</span></label>
                                <div class="col-sm-8">
                                <input type="password" name="password" class="form-control" placeholder="Password*" required>
                                </div>
                            </div>
                            <div class="input-group row mb-3">
                                <label class="col-sm-4 form-check-label"><span style="float: right">Confirm Password</span></label>
                                <div class="col-sm-8">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Retype password*" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

        </div>


        <div class="modal fade" id="edit-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Admin</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('update.admin') }}" method="POST">
                    @csrf
                    <div class="modal-body col-md-10" style="margin: auto">
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 form-check-label"><span style="float: right">First Name</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name*" required>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 form-check-label"><span style="float: right">Last Name</span></label>
                            <div class="col-sm-8">
                              <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name*" required>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 form-check-label"><span style="float: right">Phone</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*" required>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 form-check-label"><span style="float: right">Address</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="address" id="address" class="form-control" placeholder="Address*" required>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 form-check-label"><span style="float: right">Staff Type </span></label>
                            <div class="col-sm-8">
                                <select name="type" id="type" class="form-control" required>
                                    <option selected hidden>Select type</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-group row mb-3">
                            <label class="col-sm-4 form-check-label"><span style="float: right">Email </span></label>
                            <div class="col-sm-8">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required>
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" required>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
              </div>
            </div>
          </div>

    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->


@section('js')
<script>
    function editModal(val){
        $("#edit-Modal").modal('show');
        $("#first_name").val(val.first_name);
        $("#last_name").val(val.last_name);
        $("#phone").val(val.phone);
        $("#address").val(val.address);
        $("#email").val(val.email);
        $("#type").val(val.type);
        $("#id").val(val.id);
    }

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
