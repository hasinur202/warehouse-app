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
            <h1>Warehouse Setup</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Warehouse List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach ($warehouses as $warehouse)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $warehouse->warehouse_name }}</td>
                                    <td>
                                        @if($warehouse->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editModal({{ $warehouse }})" class="btn btn-dark btn-xs"><i class="fas fa-edit"></i></a>
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

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title"><i class="fas fa-plus"></i> Add Warehouse</h3>
                        </div>
                        <form action="{{ route('create.warehouse') }}" method="POST">
                                @csrf
                            <div class="card-body">
                                <div class="input-group mb-2">
                                    <input type="text" name="warehouse_name" class="form-control" placeholder="Warehouse name*" required>
                                </div>
                                <div class="input-group mb-2">
                                    <select name="status" class="form-control">
                                        <option selected value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>


        <div class="modal fade" id="edit-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('update.admin') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-2">
                            <input type="text" name="warehouse" id="warehouse" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                            <select name="status" id="status" class="form-control">
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
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
        $("#warehouse").val(val.warehouse_name);
        $("#status").val(val.status);
        $("#id").val(val.id);
    }


</script>
@endsection
@endsection
