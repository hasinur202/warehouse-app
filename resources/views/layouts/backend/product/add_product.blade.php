@extends('layouts.backend.app')

@section('css')
    <style>
        .service-img{
            height: 9.5rem;
            border: dashed 1.5px blue;
            background-image: repeating-linear-gradient(32deg, #b99dc714, transparent 100px);
            width: 100% !important;
            cursor: pointer;
        }

        .service-img input{
            opacity: 0;
            height: 9.5rem !important;
            cursor: pointer;
            padding: 0px;
        }
        .service-img img{
            height: 9.5rem;
            width: 100% !important;
            cursor: pointer;
            margin-top: -179px;
        }

        .attr input{
            width: 21%;
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
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <a href="{{ route('product.list') }}" class="btn btn-dark btn-sm float-right"><i class="fas fa-arrow-left"></i> Product List</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="addProduct">
                @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-check-label" style="font-weight: bold;color:red;">Product Barcode*</label>
                                    <input type="text" name="product_barcode" class="form-control" placeholder="Barcode">
                                </div>

                                <div class="form-group">
                                    <label class="form-check-label">Product SKU*</label>
                                    <input type="text" name="product_sku" class="form-control" placeholder="SKU">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Product Name*</label>
                                    <input type="text" name="product_name" class="form-control" placeholder="Product Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Brand*</label>
                                    <select name="brand" class="form-control">
                                        <option selected disabled>Select brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Measurement Type*</label>
                                    <select name="measurement" class="form-control">
                                        <option selected disabled>Select measurement</option>
                                        @foreach ($measurements as $measurement)
                                            <option value="{{ $measurement->id }}">{{ $measurement->measurement_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-check-label">Warehouse*</label>
                                    <select onchange="loadChildCategory(this.value)" name="warehouse_id" class="form-control">
                                        <option selected disabled>Select warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Main Category*</label>
                                    <select readonly id="main_cat_id" name="main_category" class="form-control">
                                        <option selected disabled>Select category</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Sub Category*</label>
                                    <select readonly id="sub_cat_id" name="sub_category" class="form-control">
                                        <option value="" selected disabled>Select sub category</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Child Category*</label>
                                    <select onchange="loadAllCategory(this.value)" name="child_category" id="child_cat_id" class="form-control">
                                        <option selected disabled>Select child category</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Product Type *</label>
                                    <select name="product_type" class="form-control">
                                        <option selected disabled>Select type</option>
                                        <option value="popular">Popular Product</option>
                                        <option value="trending">Trending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group attr">
                                    <label style="width: 100%">Product Attributes</label>
                                    <div class="field_wrapper">
                                        <div class="form-group">
                                            <input type="text" name="size[]" placeholder="Size">
                                            <input type="text" name="qty[]" placeholder="Quantity" style="width:12% !important">
                                            <input type="text" name="purchase_price[]" placeholder="Purchase Price">
                                            <input type="text" name="sale_price[]" id="sale_price" onkeyup="calculate()" placeholder="Sale Price">
                                            <input type="text" name="discount[]" id="discount_price" onkeyup="calculate()" placeholder="Discount">
                                            <input type="text" name="discount_p[]" id="discount_per" readonly placeholder="Discount[%]" style="width: 13 !important;margin-top:5px">
                                            <input type="text" name="c_price[]" id="current_price" readonly placeholder="Current Price" style="width: 13 !important;margin-top:5px">
                                            <a href="javascript:void(0);" class="add_button" title="Add field" style="padding:6px;"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea name="description" required placeholder="Description"></textarea>
                                </div>

                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="form-check-label col-sm-4">Product Feature Image*</label>
                                <div class="col-sm-8">
                                    <div class="service-img">
                                        <input id="image" type="file" class="form-control" name="image">
                                        <img src="" id="image-img"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Product Gallery Images [max: 4]</label>
                                <input required type="file" class="form-control" name="gallery[]" placeholder="address" multiple>
                            </div>

                            <div class="form-group">
                                <label>Product Color</label>
                                <select name="product_color[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label">Shipping Duration*</label>
                                <input type="text" name="shipp_duration" class="form-control" placeholder="Ship. duration">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Shipping Class*</label>
                                <select name="shipp_class" class="form-control">
                                    <option selected disabled>Select one</option>
                                    @foreach ($ships as $ship)
                                        <option value="{{ $ship->id }}">{{ $ship->shipping_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label">Product Condition*</label>
                                <select name="condition" class="form-control">
                                    <option selected disabled>Select one</option>
                                    <option value="Used">Used</option>
                                    <option value="New">New</option>
                                </select>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </div>

        </form>
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });

    CKEDITOR.replace('description');

</script>
<script>

    $(document).ready(function () {
        $('#addProduct').validate({
           rules: {
               warehouse_id: {
                   required: true
               },
               product_name: {
                   required: true
               },
               product_barcode: {
                   required: true
               },
               product_sku: {
                   required: true
               },
               child_category: {
                   required: true
               },
               condition: {
                   required: true
               },
               shipp_class: {
                   required: true
               },
               shipp_duration: {
                   required: true
               },
               image: {
                   required: true
               },
               brand: {
                   required: true
               },
               product_type: {
                   required: true
               },
               measurement: {
                   required: true
               },
               "purchase_price[]": {
                   required: true
               },
               "sale_price[]": {
                   required: true
               },
               "qty[]": {
                   required: true
               },
               "size[]": {
                   required: true
               },
               'product_color[]': {
                   required: true
               },
               discription: {
                    required: true
                }
           },

           messages:{
                "product_color[]": "Select product color",
                "qty[]": "Enter product quantity",
                "size[]": "Enter product size",
                "purchase_price[]": "Enter product purchase price",
                "sale_price[]": "Enter product sales price",
                "product_type": "Please check a product type",
                "image": "Please select a product feature image",
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
               for(var instanceName in CKEDITOR.instances){ CKEDITOR.instances[instanceName].updateElement();}
               $.ajax({
                   url: "{{ route('add.product') }}",
                   method: "POST",
                   data: new FormData(document.getElementById("addProduct")),
                   enctype: 'multipart/form-data',
                   dataType: 'JSON',
                   contentType: false,
                   cache: false,
                   processData: false,
                   success: function(res) {
                        $("#loading").hide();
                        Swal.fire(
                            'Good job!',
                            'Product added successfully!',
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

    function loadChildCategory(id){
        $("#loading").show();
        $.ajax({
            url:"{{ route('load.child.category') }}",
            method:"POST",
            dataType:"json",
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            success: function(res) {
                $("#main_cat_id").text('');
                $("#sub_cat_id").text('');
                $("#child_cat_id").text('');
                $("#loading").hide();

                $('#main_cat_id').append('<option selected disabled>Select category</option>');
                $('#sub_cat_id').append('<option selected disabled>Select sub category</option>');
                $('#child_cat_id').append('<option selected disabled>Select category</option>');

                res.child_categories.forEach(function (child_cat) {
                    $('#child_cat_id').append('<option value="'+child_cat.id+'">'+child_cat.category_name+'</option>');
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

    function loadAllCategory(id){
        $("#loading").show();
        $.ajax({
            url:"{{ route('load.all.category') }}",
            method:"POST",
            dataType:"json",
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            success: function(res) {
                $("#main_cat_id").text('');
                $("#sub_cat_id").text('');
                $("#loading").hide();

                res.data.forEach(function (cat) {
                    $('#main_cat_id').append('<option value="'+cat.get_main_category.id+'">'+cat.get_main_category.category_name+'</option>');
                    $('#sub_cat_id').append('<option value="'+cat.get_sub_category.id+'">'+cat.get_sub_category.category_name+'</option>');
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


    function calculate(){
        var sale_price = $("#sale_price").val();
        var discount_price = $("#discount_price").val();
        var total=0;

            total = sale_price - discount_price;
            per = (discount_price/sale_price*100);

            $("#current_price").val(total);
            $("#discount_per").val(per.toFixed(0));

    }


    function calculatee(x){
        var sale_price = $("#sale_price"+x).val();
        var discount_price = $("#discount_price"+x).val();
        var total=0;

            total = sale_price - discount_price;
            per = (discount_price/sale_price*100);

            $("#current_price"+x).val(total);
            $("#discount_per"+x).val(per.toFixed(0));
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

<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var x = 1; //Initial field counter is 1
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                var fieldHTML = '<div class="form-group"><input type="text" name="size[]" placeholder="Size" style="margin-right:3px"><input type="text" name="qty[]" placeholder="Quantity" style="width:12% !important;margin-right:3px"><input type="text" name="purchase_price[]" placeholder="Purchase Price" style="margin-right:3px"><input type="text" name="sale_price[]" onkeyup="calculatee('+x+')" id="sale_price'+x+'" placeholder="Sale Price" style="margin-right:3px"><input type="text" name="discount[]" onkeyup="calculatee('+x+')" id="discount_price'+x+'" placeholder="Discount" style="margin-right:3px"><input type="text" name="discount_p[]" id="discount_per'+x+'" readonly placeholder="Discount[%]" style="width: 13 !important;margin-right:3px"><input type="text" name="c_price[]" id="current_price'+x+'" readonly placeholder="Current Price" style="width: 13 !important;margin-right:3px;margin-top:5px"><a href="javascript:void(0);" class="remove_button" title="Remove field" style="padding:6px;"><i class="fa fa-times"></i></a></div>';
                calculatee(x);
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });





</script>
@endsection
@endsection
