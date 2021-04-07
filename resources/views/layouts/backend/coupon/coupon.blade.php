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
            <h1>Coupons</h1>
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
                            <h3 class="card-title">Coupon List</h3>
                            <button onclick="viewAdd()" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add Coupon</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Coupon Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Minimum Price</th>
                                    <th>Discount Price</th>
                                    <th>Discount [%]</th>
                                    <th>Apply Coupon</th>
                                    <th>Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach ($coupons as $coupon)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->start_date)->isoFormat('MMM Do YYYY') }}</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->end_date)->isoFormat('MMM Do YYYY') }}</td>
                                    <td>{{ $coupon->min_price }}</td>
                                    <td>{{ $coupon->discount_price }}</td>
                                    <td>{{ $coupon->discount_p }}</td>
                                    <td>{{ $coupon->apply_coupon }}</td>
                                    <td>
                                        @if($coupon->status == 1)
                                            <button onclick="changeActivity({{ $coupon->id }})" type="button" class="btn btn-success btn-block btn-xs">Active</button>
                                        @else
                                            <button onclick="changeActivity({{ $coupon->id }})" type="button" class="btn btn-danger btn-block btn-xs">Inactive</button>
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
                <div class="col-md-10" id="add_charge" style="display: none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-plus"></i> Create Coupon</h5>
                            <button onclick="closeAdd()" class="close" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="col-md-8" style="margin: auto">
                            <form id="addCoupon">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Coupon Name *</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="coupon_name" class="form-control" placeholder="Coupon name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Start Date *</label>
                                        <div class="col-sm-8">
                                            <input type="date" name="start_date" class="form-control" placeholder="Start date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">End Date *</label>
                                        <div class="col-sm-8">
                                            <input type="date" name="end_date" class="form-control" placeholder="End date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Minimum Price *</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="min_price" class="form-control" placeholder="Minimum price">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Discount [%] *</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="discount_p" class="form-control" placeholder="Discount per(%)">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Discount Price *</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="discount_price" class="form-control" placeholder="Discount Price">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Apply Coupon *</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="apply_coupon" class="form-control" placeholder="Apply coupon">
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




    function viewAdd(){
        $("#charge_list").hide();
        $("#add_charge").show();
    }

    function closeAdd(){
        $("#add_charge").hide();
        $("#charge_list").show();
    }


    $(document).ready(function () {
        $('#addCoupon').validate({
           rules: {
               coupon_name: {
                   required: true
               },
               start_date: {
                   required: true
               },
               end_date: {
                   required: true
               },
               min_price: {
                   required: true
               },
               discount_price: {
                   required: true
               },
               discount_p: {
                   required: true
               },
               apply_coupon: {
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
               $("#loading").show();
               $.ajax({
                   url: "{{ route('coupon.store') }}",
                   method: "POST",
                   data: new FormData(document.getElementById("addCoupon")),
                   enctype: 'multipart/form-data',
                   dataType: 'JSON',
                   contentType: false,
                   cache: false,
                   processData: false,
                   success: function(res) {
                        $("#loading").hide();
                        Swal.fire(
                            'Good job!',
                            'Coupon created successfully!',
                            'success'
                        )
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                   },
                   error: function(response) {
                        $("#loading").hide();
                        $.each(response.responseJSON.errors,function(field_name,error){
                            $(document).find('[name='+field_name+']').after('<span class="text-strong text-danger">' +error+ '</span>')
                        })
                   }
               })
           }
       });

   });



</script>
@endsection
@endsection
