@extends('layouts.backend.app')

@section('css')

    <style>
        .service-img{
            height: 6.5rem;
            border: dashed 1.5px blue;
            background-image: repeating-linear-gradient(32deg, #b99dc714, transparent 100px);
            width: 68.5% !important;
            cursor: pointer;
        }

        .service-img input{
            opacity: 0;
            height: 6.5rem;
            cursor: pointer;
            padding: 0px;
        }
        .service-img img{
            height: 6.5rem;
            width: 100% !important;
            cursor: pointer;
            margin-top: -134px;
        }
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
            <h1>Main Category</h1>
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
                            <h3 class="card-title">Main Category List</h3>
                            <button data-toggle="modal" data-target="#addModal" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add Category</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Category Name</th>
                                    <th>Icon</th>
                                    <th>Warehouse</th>
                                    <th>Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach ($main_cats as $cat)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $cat->category_name }}</td>
                                    <td>
                                        {{--  <img src="/images/technology/{{ $tech->logo }}" height="40px" width="70px">  --}}
                                    </td>
                                    <td>
                                        @if($admin->status == 1)
                                            <button onclick="changeActivity({{ $cat->id }})" type="button" class="btn btn-success btn-block btn-xs">Active</button>
                                        @else
                                            <button onclick="changeActivity({{ $cat->id }})" type="button" class="btn btn-danger btn-block btn-xs">Inactive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editModal({{ $cat }})" class="btn btn-dark btn-xs"><i class="fas fa-edit"></i></a>
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
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('create.admin') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="warehouse" class="form-control">
                                    <option selected disabled>Select Warehouse</option>
                                    <option value="">US</option>
                                    <option value="">UK</option>
                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <input type="text" name="category_name" class="form-control" placeholder="Category name*" required>
                            </div>
                            <div class="input-group mb-2">
                                  <input type="text" name="slug" class="form-control" placeholder="Slug*" required>
                            </div>
                            <div class="form-group">
                                <label class="check-input-label">Main Category Icon</label>
                                <div class="service-img" style="width: 50% !important">
                                    <input id="image" type="file" class="form-control" name="logo">
                                    <img src="" id="image-img"/>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
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
                  <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('update.admin') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-2">
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                              <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>
                        <div class="input-group mb-2">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*" required>
                        </div>
                        <div class="input-group mb-2">
                            <input type="text" name="address" id="address" class="form-control" placeholder="Address*" required>
                        </div>

                        <div class="input-group mb-2">
                            <input type="email" name="email" id="email" class="form-control" required>
                            <input type="hidden" name="id" id="id" required>
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



    function imageUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        imageUrl(this);
    });
</script>
@endsection
@endsection
