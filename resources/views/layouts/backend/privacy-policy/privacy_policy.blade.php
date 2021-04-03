@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @include('layouts.backend.include.message')

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Privacy & Policy</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <form action="{{ route('about.save') }}" method="POST" role="form">
                @csrf
            <input name="id" hidden type="text" hidden value="{{ optional($privacy)->id }}" class="form-control" />

            <div style="float: left" class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Privacy & Policy Description</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <textarea name="description" id="description" placeholder="Place some text here">
                          {{ optional($privacy)->description }}
                        </textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
        </div>

        </div>
    </section>
    <!-- /.content -->
  </div>

@section('js')
<script>
    CKEDITOR.replace('description');
</script>


<script>


</script>

@endsection
@endsection
