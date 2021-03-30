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
          {{-- <div class="col-sm-6">
            <button data-toggle="modal" data-target="#addModal" class="btn btn-dark float-right"><i class="fas fa-plus"></i> Add Product</button>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('test') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-check-label" style="font-weight: bold;color:red;">Product Barcode*</label>
                                    <input type="text" name="barcode" class="form-control" placeholder="Barcode">
                                </div>

                                <div class="form-group">
                                    <label class="form-check-label">Product SKU*</label>
                                    <input type="text" name="barcode" class="form-control" placeholder="SKU">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Product Name*</label>
                                    <input type="text" name="barcode" class="form-control" placeholder="Product Name">
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Brand*</label>
                                    <select name="warehouse_id" class="form-control">
                                        <option selected disabled>Select brand</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-check-label">Warehouse*</label>
                                    <select name="warehouse_id" class="form-control">
                                        <option selected disabled>Select warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Main Category*</label>
                                    <select name="warehouse_id" class="form-control">
                                        <option selected disabled>Select category</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Sub Category*</label>
                                    <select name="warehouse_id" class="form-control">
                                        <option selected disabled>Select sub category</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">Child Category*</label>
                                    <select name="warehouse_id" class="form-control">
                                        <option selected disabled>Select child category</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="width: 100%">Product Attributes</label>
                                    <input type="text" name="dd" placeholder="Size">
                                    <input type="text" name="dd" placeholder="Quantity">
                                    <input type="text" name="dd" placeholder="Discount">

                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea name="description" placeholder="Description" required class="form-control"></textarea>
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
                                <label class="form-check-label">Product Gallery Images</label>
                                <input required type="file" class="form-control" name="images[]" placeholder="address" multiple>
                            </div>
                            <div style="text-align:center">
                                <span class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add More</span>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <button type="submit" class="btn btn-info">Submit</button>
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
    CKEDITOR.replace('description');
</script>
<script>
   
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
