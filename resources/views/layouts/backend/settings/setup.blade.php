@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @include('layouts.backend.include.message')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Website Info</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <form action="{{ route('settings.save') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                <input name="id" hidden type="text" hidden value="{{ optional($setting)->id }}" class="form-control" placeholder="Enter Email" />

            <div style="float: left" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Setup Basic Info</h3>
                    </div>
                    <div class="card-body">

                        <div class="col-md-6" style="float: left; padding-left: 0">
                            <div class="form-group">
                                <label>Website Title *</label>
                                <input name="title" type="text" value="{{ optional($setting)->title }}" class="form-control" placeholder="Enter website title" />
                            </div>
                            <div class="form-group">
                                <label>Contact No. *</label>
                                <input name="contact" value="{{ optional($setting)->contact }}" type="text" class="form-control" placeholder=" Enter contact number" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" value="{{ optional($setting)->email }}" type="email" class="form-control" placeholder="Enter Email" />
                            </div>
                        </div>

                        <div class="col-md-6" style="float: right; padding-right:0px !important">
                            <div class="form-group">
                                <label for="logo">Logo *</label>
                                <div style="height: 7.7rem; border: dashed 1.5px blue;
                                background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                width: 100% !important; cursor: pointer;">
                                <input id="image" type="file" class="form-control" name="logo" style="opacity: 0; height: 7.7rem; cursor: pointer; padding: 0px;">
                                <img src="images/logo/{{ optional($setting)->logo }}" id="image-img" style="height: 7.7rem; width: 100% !important; cursor: pointer;margin-top: -154px;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" type="text" class="form-control" placeholder="Enter Address">{{ optional($setting)->address }}</textarea>
                        </div>
                    </div>

                        <div class="form-group">
                            <label style="width: 100%">Website Description</label>
                            <textarea name="description" type="text" class="form-control" placeholder="Enter description">{{ optional($setting)->description }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div style="float: right" class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Social Link</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input value="{{ optional($setting)->fb_link }}" name="fb_link" type="text" class="form-control" placeholder="Facebook link" />
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input value="{{ optional($setting)->twitt_link }}" name="twitt_link" type="text" class="form-control" placeholder="Twitter link" />
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input value="{{ optional($setting)->insta_link }}" name="insta_link" type="text" class="form-control" placeholder="Instagram link" />
                        </div>
                        <div class="form-group">
                            <label>Youtube</label>
                            <input value="{{ optional($setting)->tube_link }}" name="tube_link" type="text" class="form-control" placeholder="Youtube link" />
                        </div>
                    </div>
                </div>
            </div>
                <div class="card" style="width: 100%">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
        </form>
        </div>

        </div>
    </section>
    <!-- /.content -->
  </div>

@section('js')
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


</script>

@endsection
@endsection
