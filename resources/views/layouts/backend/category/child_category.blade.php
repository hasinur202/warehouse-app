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
            <h1>Child Category</h1>
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
                            <h3 class="card-title">Child Category List</h3>
                            <button data-toggle="modal" data-target="#addModal" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add Sub Category</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Main Category</th>
                                    <th>Sub Category</th>
                                    <th>Child Category</th>
                                    <th>Icon</th>
                                    <th>Warehouse</th>
                                    <th width="70px">Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach ($child_cats as $cat)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $cat->get_main_category->category_name }}</td>
                                    <td>{{ $cat->get_sub_category->category_name }}</td>
                                    <td>{{ $cat->category_name }}</td>
                                    <td>
                                        <img src="/images/child_category/{{ $cat->icon }}" alt="Category Icon" height="40px" width="70px">
                                    </td>
                                    <td>{{ $cat->get_warehouse->warehouse_name }}</td>
                                    <td>
                                        @if($cat->status == 1)
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
                    <div class="modal-header bg-info">
                      <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="addCategory">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <select onchange="loadMainCategory(this.value)" name="warehouse_id" class="form-control">
                                    <option selected disabled>Select warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="main_cat_id" id="main_cat_id" class="form-control">
                                    <option selected disabled>Select main category</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="category_name" class="form-control" placeholder="Sub category name*">
                            </div>
                            <div class="form-group mt-4" style="display: inline-flex">
                                <label class="form-check-label mr-4">Sub Category Icon</label>
                                <div class="service-img" style="width: 30% !important">
                                    <input id="image" type="file" class="form-control" name="icon">
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
                  <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('update.sub.category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group row">
                            <label class="form-check-label col-sm-4">Warehouse</label>
                            <div class="col-sm-8">
                                <select onchange="loadMainCategory(this.value)" name="warehouse_id" id="warehouse_id" class="form-control">
                                    <option selected disabled>Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-check-label col-sm-4">Main Category</label>
                            <div class="col-sm-8">
                                <select name="edit_main_cat_id" id="edit_main_cat_id" class="form-control">
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label class="form-check-label col-sm-4">Sub Category</label>
                            <div class="col-sm-8">
                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category name*">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label class="form-check-label col-sm-4">Sub Category Icon</label>
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

        $('#edit_main_cat_id').append('<option selected value="'+val.get_main_category.id+'">'+val.get_main_category.category_name+'</option>');

        $("#edit-image-img").attr('src', "{{ asset('/images/sub_category') }}/" + val.icon);

        $("#id").val(val.id);
    }


    $(document).ready(function () {
        $('#addCategory').validate({
           rules: {
               warehouse_id: {
                   required: true
               },
               main_cat_id: {
                    required: true
                },
               category_name: {
                   required: true
               },
               icon: {
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
               $("#addCategory").css({'opacity':'0.8'})
               $("#loading").show();

               $.ajax({
                   url: "{{route('add.sub.category')}}",
                   method: "POST",
                   data: new FormData(document.getElementById("addCategory")),
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
                            title: 'Category created successfully'
                       })
                   },
                   error: function(err) {
                       $("#loading").hide();

                       if(err.status == 422){
                           Swal.fire({
                               icon: 'error',
                               title: 'Category name should be unique'
                           })
                       }
                   }
               })
           }
       });

   });


    function loadMainCategory(id){
        $("#loading").show();
        $.ajax({
            url:"{{ route('load.main.category') }}",
            method:"POST",
            dataType:"json",
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            success: function(res) {
                $("#main_cat_id").text('');
                $("#edit_main_cat_id").text('');
                $("#loading").hide();

                res.data.forEach(function (m_cat) {
                    $('#main_cat_id').append('<option value="'+m_cat.id+'">'+m_cat.category_name+'</option>');
                    $('#edit_main_cat_id').append('<option value="'+m_cat.id+'">'+m_cat.category_name+'</option>');
                });

            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Wrong'
                })
            }
        })
    }

    function changeActivity(id){
        $("#loading").show();
        $.ajax({
            url:"{{ route('sub.category.activity') }}",
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
