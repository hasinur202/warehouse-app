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
            <h1>Colors</h1>
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

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-plus"></i> Add Color</h5>
                        </div>
                        <form id="addColor">
                            @csrf
                            <div class="card-body">
                                <div class="form-group mb-2">
                                    <input type="text" name="color_name" class="form-control" placeholder="Color name*">
                                </div>
                            </div>
                            <div class="card-footer">
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
                <form action="{{ route('update.color') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 form-check-label">Color name</label>
                            <div class="col-sm-8">
                                <input type="text" name="color_name" id="color_name" class="form-control" placeholder="Color name*">
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

        $("#color_name").val(val.color_name);
        $("#id").val(val.id);
    }


    $(document).ready(function () {
        $('#addColor').validate({
           rules: {
               color_name: {
                   required: true
               },
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
               $("#addColor").css({'opacity':'0.8'})
               $("#loading").show();

               $.ajax({
                   url: "{{ route('add.color') }}",
                   method: "POST",
                   data: new FormData(document.getElementById("addColor")),
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
                            title: 'Color created successfully'
                       })
                   },
                   error: function(err) {
                       $("#loading").hide();

                       if(err.status == 422){
                           Swal.fire({
                               icon: 'error',
                               title: 'Color name should be unique'
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
            url:"{{ route('color.activity') }}",
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






</script>
@endsection
@endsection