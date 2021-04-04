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
            <h1>Delivery Charges</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" id="charge_list">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Charges List</h3>
                            <button onclick="viewAdd()" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add Charge</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Country Name</th>
                                    <th>State Name</th>
                                    <th>Shipping Name</th>
                                    <th>Charge</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            {{--  <tbody>
                                @php $i=0; @endphp
                                @foreach ($main_cats as $cat)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $cat->category_name }}</td>
                                    <td>
                                        <img src="/images/main_category/{{ $cat->icon }}" alt="Category Icon" height="40px" width="70px">
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
                            </tbody>  --}}
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                </div>
                <div class="col-md-10" id="add_charge" style="display: none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-edit"></i> Create/Update Delivery Charge</h5>
                            <button onclick="closeAdd()" class="close" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="col-md-8" style="margin: auto">
                            <form method="POST" action="{{ route('deliverychargeadd.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="form-check-label col-sm-4">Country Name *</label>
                                        <div class="col-sm-8">
                                            <select onchange="district_find(this.value)" name="warehouse_id" id="warehouse_id" class="form-control">
                                                <option selected disabled>Select country</option>
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-4 form-check-label">State Name *</label>
                                        <div class="col-sm-8">
                                            <div style='text-align:center;' class='span12'>
                                                <label style='float:left'  class='linkname'>
                                                    <input id="chkbx_all"  onclick="return check_all()" type="checkbox" />&nbsp;
                                                    <span><strong class="text-danger ">Select All</strong></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4"></label>
                                        <div id="state" class="col-sm-8">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="form-check-label col-sm-4">Shipping Class *</label>
                                        <div class="col-sm-8">
                                            <select name="shipping_id" id="shipping_id" class="form-control">
                                                <option selected disabled>Select country</option>
                                                @foreach ($ships as $ship)
                                                    <option value="{{ $ship->id }}">{{ $ship->shipping_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Charge *</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="charge" id="charge" class="form-control" placeholder="Charge">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-4"></label>
                                        <div class="col-sm-8">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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


    function district_find(id) {
        $("#loading").show();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            url: "{{ route('district.find') }}",
            type: 'POST',
            data: {country_id: id},
            success: function(data){
                $("#loading").hide();
                $('#state').html(data);
                //GetBrand();
            },
            error: function() {
                $("#loading").hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Something Wrong'
                })
            }

        });

    }

    function check_all(){
    if($('#chkbx_all').is(':checked')){
      $('input.check_elmnt2').prop('disabled', false);
      $('input.check_elmnt').prop('checked', true);
      $('input.check_elmnt2').prop('checked', true);
    }else{
      $('input.check_elmnt2').prop('disabled', true);
      $('input.check_elmnt').prop('checked', false);
      $('input.check_elmnt2').prop('checked', false);
      }
  }


    function viewAdd(){
        $("#charge_list").hide();
        $("#add_charge").show();
    }

    function closeAdd(){
        $("#add_charge").hide();
        $("#charge_list").show();
    }


    $(document).ready(function () {
        $('#addCategory').validate({
           rules: {
               warehouse_id: {
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
                   url: "{{route('add.main.category')}}",
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



</script>
@endsection
@endsection
