@extends('layouts.backend.app')

@section('css')

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
        <div class="row mb-2" id="productTitle">
          <div class="col-sm-6">
            <h1>Product List</h1>
          </div>
          <div class="col-sm-6">
            <a href="{{ route('product.add') }}" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add Product</a>
          </div>
        </div>
        <div class="row mb-2 col-sm-6" id="productEditTitle" style="display: none">
            <h4>Product Details</h4/>
            <a style="margin-left: 1rem; background: #0c3d97; cursor:pointer; padding: 1px 18px 4px 18px; border-radius: 22px;
                font-weight: 500; color: #fff;
                height: 28px;" onclick="back()"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" id="productList">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Warehouse</th>
                                    <th>Barcode</th>
                                    <th>SKU</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Child Category</th>
                                    <th>Qty</th>
                                    <th>Shipp. Class</th>
                                    <th width="70px">Status</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->get_warehouse->warehouse_name }}</td>
                                    <td>{{ $product->product_barcode }}</td>
                                    <td>{{ $product->product_sku }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>
                                        <img src="/images/product/{{ $product->feature_image }}" alt="Product Image" height="40px" width="50px">
                                    </td>
                                    <td>{{ $product->main_category->category_name }}</td>
                                    <td>{{ $product->sub_category->category_name }}</td>
                                    <td>{{ $product->child_category->category_name }}</td>
                                    <td>{{ $product->attributes->sum('qty') }}</td>
                                    <td>{{ $product->shipping_class->shipping_name }}</td>

                                    <td>
                                        @if($product->status == 1)
                                            <button onclick="changeActivity({{ $product->id }})" type="button" class="btn btn-success btn-block btn-xs">Active</button>
                                        @else
                                            <button onclick="changeActivity({{ $product->id }})" type="button" class="btn btn-danger btn-block btn-xs">Inactive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editModal({{ $product->id }})" class="btn btn-dark btn-xs"><i class="fas fa-edit"></i></a>
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


        <form id="updateProduct">
            @csrf
            <div class="row" id="editProduct" style="display: none;">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-check-label" style="font-weight: bold;color:red;">Product Barcode*</label>
                                    <input type="text" name="product_barcode" id="product_barcode" class="form-control" placeholder="Barcode">
                                </div>

                                <div class="form-group">
                                    <label class="form-check-label">Product SKU*</label>
                                    <input type="text" name="product_sku" id="product_sku" class="form-control" placeholder="SKU">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Product Name*</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Brand*</label>
                                    <select name="brand" id="brand_id" class="form-control">
                                        <option selected disabled>Select brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Measurement Type*</label>
                                    <select name="measurement" id="measurement_id" class="form-control">
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
                                    <select onchange="loadChildCategory(this.value)" name="warehouse_id" id="warehouse_id" class="form-control">
                                        <option selected disabled>Select warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Main Category*</label>
                                    <select readonly id="main_cat_id" name="main_category" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Sub Category*</label>
                                    <select readonly id="sub_cat_id" name="sub_category" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Child Category*</label>
                                    <select onchange="loadAllCategory(this.value)" name="child_category" id="child_cat_id" class="form-control">
                                        {{--  <option selected disabled>Select child category</option>  --}}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-check-label">Product Type *</label>
                                    <select name="product_type" id="product_type" class="form-control">
                                        <option selected disabled>Select type</option>
                                        <option value="popular">Popular Product</option>
                                        <option value="trending">Trending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group attr">
                                    <label style="width: 100%">Product Attributes</label>
                                    <div class="field_wrapper" id="edit_p">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea name="description" id="description" required placeholder="Description"></textarea>
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
                            <div class="form-group row">
                                <label style="width:100%">Product Gallery Images</label>
                                <div class="col-sm-4">
                                    <div class="service-img" style="height: 5.5rem !important">
                                        <input id="image1" type="file" class="form-control" name="image1" style="height: 5.5rem !important">
                                        <img src="" id="image-img1" style="height: 5.5rem !important;margin-top:-118px !important"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="service-img" style="height: 5.5rem !important">
                                        <input id="image2" type="file" class="form-control" name="image2" style="height: 5.5rem !important">
                                        <img src="" id="image-img2" style="height: 5.5rem !important;margin-top:-118px !important"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="service-img" style="height: 5.5rem !important">
                                        <input id="image3" type="file" class="form-control" name="image3" style="height: 5.5rem !important">
                                        <img src="" id="image-img3" style="height: 5.5rem !important;margin-top:-118px !important"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Product Color</label>
                                <select name="product_color[]" class="select2"  id="product_color" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                     {{-- @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label">Shipping Duration*</label>
                                <input type="text" name="shipp_duration" id="shipp_duration" class="form-control" placeholder="Ship. duration">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Shipping Class*</label>
                                <select name="shipp_class" id="shipping_id" class="form-control">
                                    <option selected disabled>Select one</option>
                                    @foreach ($ships as $ship)
                                        <option value="{{ $ship->id }}">{{ $ship->shipping_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label">Product Condition*</label>
                                <select name="condition" id="condition" class="form-control">
                                    <option selected disabled>Select one</option>
                                    <option value="Used">Used</option>
                                    <option value="New">New</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <input id="id" type="hidden" class="form-control" name="id">
                    <button type="submit" class="btn btn-success">Update</button>
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
    function editModal(id){
        $("#loading").show();
        $.ajax({
            url:"{{ route('edit.product') }}",
            method:"POST",
            dataType:"json",
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            success: function(res) {
                $("#loading").hide();
                $("#productTitle").hide();
                $("#productEditTitle").show();
                $("#productList").hide();
                $("#editProduct").show();

                res.main_categories.forEach(function (main_cat) {
                    if(res.product.main_category_id == main_cat.id){
                        $('#main_cat_id').append('<option selected value="'+main_cat.id+'">'+main_cat.category_name+'</option>');
                    }
                });
                res.main_categories.forEach(function (sub_cat) {
                    if(res.product.sub_category_id == sub_cat.id){
                        $('#sub_cat_id').append('<option selected value="'+sub_cat.id+'">'+sub_cat.category_name+'</option>');
                    }
                });
                res.child_categories.forEach(function (child_cat) {
                    if(res.product.child_category_id == child_cat.id){
                        $('#child_cat_id').append('<option selected value="'+child_cat.id+'">'+child_cat.category_name+'</option>');
                    }
                });

                $("#id").val(res.product.id);
                $("#product_barcode").val(res.product.product_barcode);
                $("#product_sku").val(res.product.product_sku);
                $("#product_name").val(res.product.product_name);
                $("#warehouse_id").val(res.product.warehouse_id);
                $("#brand_id").val(res.product.brand_id);

                CKEDITOR.instances['description'].setData(res.product.description);
                // $("#exampleCheck2").attr('checked',true);

                $("#product_type").val(res.product.product_type);
                $("#shipping_id").val(res.product.shipping_id);
                $("#measurement_id").val(res.product.measurement_id);
                $("#shipp_duration").val(res.product.shipp_duration);
                $("#condition").val(res.product.condition);
                $("#image-img").attr('src', "{{ asset('/images/product') }}/" + res.product.feature_image);
                $("#image-img1").attr('src', "{{ asset('/images/product') }}/" + res.product.image1);
                $("#image-img2").attr('src', "{{ asset('/images/product') }}/" + res.product.image2);
                $("#image-img3").attr('src', "{{ asset('/images/product') }}/" + res.product.image3);


                $('#product_color').text('');
                res.colors.forEach(function (cc){
                    res.product.colors.forEach(function (color) {
                        if(cc.id == color.id){
                            $('#product_color').append("<option value='"+color.id+"' selected='selected' hidden>"+color.color_name+"</option>");
                        }
                    });
                    $('#product_color').append("<option hidden value='"+cc.id+"'>"+cc.color_name+"</option>");
                });

                $('#edit_p').text('');
                var i =0;
                res.product.attributes.forEach(function (attr) {
                    i++;
                    if(i==1){
                        $('#edit_p').append('<div class="form-group"><input type="text" name="size[]" value="'+attr.size+'" placeholder="Size"><input type="text" name="qty[]" value="'+attr.qty+'" placeholder="Quantity" style="width:12% !important;margin-left: 3px;"><input type="text" name="purchase_price[]" value="'+attr.purchase_price+'" placeholder="Purchase Price" style="margin-left: 3px;"><input type="text" name="sale_price[]" value="'+attr.sale_price+'" id="sale_price" onkeyup="calculate()" placeholder="Sale Price" style="margin-left: 3px;"><input type="text" name="discount[]" value="'+attr.discount+'" id="discount_price" onkeyup="calculate()" placeholder="Discount" style="margin-left: 3px;"><input type="text" name="discount_p[]" value="'+attr.discount_p+'" id="discount_per" readonly placeholder="Discount[%]" style="width: 13 !important;margin-top:5px;"><input type="text" name="c_price[]" value="'+attr.current_price+'" id="current_price" readonly placeholder="Current Price" style="width: 13 !important;margin-top:5px;margin-left: 3px;"><a href="javascript:void(0);" onclick="addMoreAttr()" class="add_button" title="Add field" style="padding:6px;"><i class="fa fa-plus"></i></a></div>');
                    }else{
                        $('#edit_p').append('<div class="form-group"><input type="text" name="size[]" value="'+attr.size+'" placeholder="Size"><input type="text" name="qty[]" value="'+attr.qty+'" placeholder="Quantity" style="width:12% !important;margin-left: 3px;"><input type="text" name="purchase_price[]" value="'+attr.purchase_price+'" placeholder="Purchase Price" style="margin-left: 3px;"><input type="text" name="sale_price[]" value="'+attr.sale_price+'" id="sale_price'+attr.id+'" onkeyup="calculatee('+attr.id+')" placeholder="Sale Price" style="margin-left: 3px;"><input type="text" name="discount[]" value="'+attr.discount+'" id="discount_price'+attr.id+'" onkeyup="calculatee('+attr.id+')" placeholder="Discount" style="margin-left: 3px;"><input type="text" name="discount_p[]" value="'+attr.discount_p+'" id="discount_per'+attr.id+'" readonly placeholder="Discount[%]" style="width: 13 !important;margin-top:5px;"><input type="text" name="c_price[]" value="'+attr.current_price+'" id="current_price'+attr.id+'" readonly placeholder="Current Price" style="width: 13 !important;margin-top:5px;margin-left: 3px;"></div>');
                    }
                });
            },

            error: function() {
                $("#loading").hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!'
                })
            }
        })

    }


    $(document).ready(function () {
        $('#updateProduct').validate({
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
                   url: "{{ route('update.product') }}",
                   method: "POST",
                   data: new FormData(document.getElementById("updateProduct")),
                   enctype: 'multipart/form-data',
                   dataType: 'JSON',
                   contentType: false,
                   cache: false,
                   processData: false,
                   success: function(res) {
                        $("#loading").hide();

                        Swal.fire(
                            'Good job!',
                            'Product updated successfully!',
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

    function back(){
        $("#productEditTitle").hide();
        $("#productTitle").show();
        $("#editProduct").hide();
        $("#productList").show();
        $("#updateProduct").reset();
    }


    function changeActivity(id){
        $("#loading").show();
        $.ajax({
            url:"{{ route('product.activity') }}",
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


    function urlImage1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-img1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function urlImage2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-img2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function urlImage3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-img3').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        imageUrl(this);
    });

    $("#image1").change(function() {
        urlImage1(this);
    });
    $("#image2").change(function() {
        urlImage2(this);
    });

    $("#image3").change(function() {
        urlImage3(this);
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

    function addMoreAttr(){

        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var x = 1; //Initial field counter is 1
        //Once add button is clicked

            //Check maximum number of input fields
            if(x < maxField){
                var fieldHTML = '<div class="form-group"><input type="text" name="size[]" placeholder="Size" style="margin-right:3px"><input type="text" name="qty[]" placeholder="Quantity" style="width:12% !important;margin-right:3px"><input type="text" name="purchase_price[]" placeholder="Purchase Price" style="margin-right:3px"><input type="text" name="sale_price[]" onkeyup="calculatee('+x+')" id="sale_price'+x+'" placeholder="Sale Price" style="margin-right:3px"><input type="text" name="discount[]" onkeyup="calculatee('+x+')" id="discount_price'+x+'" placeholder="Discount" style="margin-right:3px"><input type="text" name="discount_p[]" id="discount_per'+x+'" readonly placeholder="Discount[%]" style="width: 13 !important;margin-right:3px"><input type="text" name="c_price[]" id="current_price'+x+'" readonly placeholder="Current Price" style="width: 13 !important;margin-right:3px;margin-top:5px"><a href="javascript:void(0);" class="remove_button" title="Remove field" style="padding:6px;"><i class="fa fa-times"></i></a></div>';
                calculatee(x);
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }


        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    }

</script>

@endsection
@endsection
