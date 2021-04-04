@extends('layouts.backend.app')

@section('css')


@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @include('layouts.backend.include.message')
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brands</h1>
          </div>
          <div class="col-sm-6">
            <button data-toggle="modal" data-target="#addModal" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add Color</button>
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
                            <h3 class="card-title">Color List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Color</th>
                                    <th width="70px">Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach ($colors as $color)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $color->color_name }}</td>
                                    <td>
                                        @if($color->status == 1)
                                            <button onclick="changeActivity({{ $color->id }})" type="button" class="btn btn-success btn-block btn-xs">Active</button>
                                        @else
                                            <button onclick="changeActivity({{ $color->id }})" type="button" class="btn btn-danger btn-block btn-xs">Inactive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editModal({{ $color }})" class="btn btn-dark btn-xs"><i class="fas fa-edit"></i></a>
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
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> Add Brand</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="addColor">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <input type="text" name="color_name" class="form-control" placeholder="Color name*">
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
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Color</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('update.brand') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 form-check-label">Color name</label>
                            <div class="col-sm-8">
                                <input type="text" name="brand_name" id="color_name" class="form-control" placeholder="Color name*">
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

        $("#brand_name").val(val.brand_name);
        $("#edit-image-img").attr('src', "{{ asset('/images/brand') }}/" + val.logo);

        $("#id").val(val.id);
    }


    $(document).ready(function () {
        $('#addBrand').validate({
           rules: {
               brand_name: {
                   required: true
               },
               logo: {
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
               $("#addBrand").css({'opacity':'0.8'})
               $("#loading").show();

               $.ajax({
                   url: "{{ route('add.brand') }}",
                   method: "POST",
                   data: new FormData(document.getElementById("addBrand")),
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
                            title: 'Brand created successfully'
                       })
                   },
                   error: function(err) {
                       $("#loading").hide();

                       if(err.status == 422){
                           Swal.fire({
                               icon: 'error',
                               title: 'Brand name should be unique'
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
            url:"{{ route('brand.activity') }}",
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
