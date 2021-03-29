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
            <h1>Home Slider</h1>
          </div>
          <div class="col-sm-6">
            <button data-toggle="modal" data-target="#addModal" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Add Slider</button>
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
                            <h3 class="card-title">Slider List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Url</th>
                                    <th>Warehouse</th>
                                    <th width="70px">Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach ($slides as $slide)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $slide->title }}</td>
                                    <td>
                                        <img src="/images/slider/{{ $slide->image }}" alt="Slider" height="40px" width="70px">
                                    </td>
                                    <td>{{ $slide->url }}</td>
                                    <td>{{ $slide->get_warehouse->warehouse_name }}</td>
                                    <td>
                                        @if($slide->status == 1)
                                            <button onclick="changeActivity({{ $slide->id }})" type="button" class="btn btn-success btn-block btn-xs">Active</button>
                                        @else
                                            <button onclick="changeActivity({{ $slide->id }})" type="button" class="btn btn-danger btn-block btn-xs">Inactive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editModal({{ $slide }})" class="btn btn-dark btn-xs"><i class="fas fa-edit"></i></a>
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
                    <div class="modal-header bg-info">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Slider</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="addSlider">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="warehouse_id" class="form-control">
                                    <option selected disabled>Select Warehouse*</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="title" class="form-control" placeholder="Title *">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="url" class="form-control" placeholder="Url ">
                            </div>
                            <div class="form-group mt-4" style="display: inline-flex">
                                <label class="form-check-label mr-4">Image</label>
                                <div class="service-img" style="width: 80% !important">
                                    <input id="image" type="file" class="form-control" name="image">
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
                <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('update.main.category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group row">
                            <label class="col-sm-4 form-check-label">Warehouse</label>
                            <div class="col-sm-8">
                                <select name="warehouse_id" id="warehouse_id" class="form-control">
                                    <option selected disabled>Select warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 form-check-label">Category name</label>
                            <div class="col-sm-8">
                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category name*">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label class="form-check-label col-sm-4">Main Category Icon</label>
                            <div class="col-sm-8">
                                <div class="service-img" style="width: 40% !important">
                                    <input id="edit-image" type="file" class="form-control" name="icon">
                                    <img src="" id="edit-image-img"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
              </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

  <div id="loading" style="display:none; z-index:9999; position: absolute;width: 100%;text-align: center;top: 15rem;font-size: 3rem;color: #7ca6b2;">
    <i class="fas fa-spinner fa-pulse"></i>
</div>

@section('js')
<script>
    function editModal(val){
        $("#edit-Modal").modal('show');

        $("#category_name").val(val.category_name);
        $("#warehouse_id").val(val.get_warehouse.id);
        $("#edit-image-img").attr('src', "{{ asset('/images/slider') }}/" + val.icon);

        $("#id").val(val.id);
    }


    $(document).ready(function () {
        $('#addSlider').validate({
           rules: {
               warehouse_id: {
                   required: true
               },
               title: {
                   required: true
               },
               image: {
                   required: true
               }
           },
           errorElement: 'span',
           errorPlacement: function (error, element) {
               error.addClass('invalid-feedback');
               element.closest('.form-group').append(error);
           },
           highlight: function (element, errorClass, validClass) {
               $(element).addClass('is-invalid');
           },
           unhighlight: function (element, errorClass, validClass) {
               $(element).removeClass('is-invalid');
           },
           submitHandler: function(form){
               $("#addSlider").css({'opacity':'0.8'})
               $("#loading").show();

               $.ajax({
                   url: "{{ route('add.slider') }}",
                   method: "POST",
                   data: new FormData(document.getElementById("addSlider")),
                   enctype: 'multipart/form-data',
                   dataType: 'JSON',
                   contentType: false,
                   cache: false,
                   processData: false,
                   success: function(res) {
                        $("#loading").hide();
                        window.location.reload();
                        Toast.fire({
                            icon: 'success',
                            title: 'Slider created successfully'
                       })
                   },
                   error: function(err) {
                       $("#loading").hide();

                       if(err.status == 422){
                           Swal.fire({
                               icon: 'error',
                               title: 'Slider name should be unique'
                           })
                       }
                   }
               })
           }
       });

   });


    function changeActivity(id){
        $("#loading").show();
        $.ajax({
            url:"{{ route('main.category.activity') }}",
            method:"POST",
            dataType:"json",
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            success: function(response) {
                $("#loading").hide();
                Toast.fire({
                    icon: 'success',
                    title: 'Status Changes Successfully.'
                })
                window.location.reload();
            },
            error: function() {
                $("#loading").hide();
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


    function editimageUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#edit-image-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#edit-image").change(function() {
        editimageUrl(this);
    });



</script>
@endsection
@endsection