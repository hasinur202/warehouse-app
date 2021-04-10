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
            <h1>Expenses</h1>
          </div>
          <div class="col-sm-6">
            <button onclick="viewAdd()" class="btn btn-dark btn-sm float-right"><i class="fas fa-plus"></i> Add Expense</button>
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
                            <h3 class="card-title">Expense List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Name</th>
                                    <th>Invoice Number</th>
                                    <th>Date</th>
                                    <th>Expense Head</th>
                                    <th>Amount</th>
                                    <th>
                                        <img style="height: 20px; width:50px;" src="/backend/images/action.png">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach ($expenses as $expense)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $expense->expense_name }}</td>
                                    <td>{{ $expense->invoice_no }}</td>
                                    <td>{{ Carbon\Carbon::parse($expense->date)->isoFormat('MMM Do YYYY') }}</td>

                                    <td>{{ $expense->expense_head->head_name }}</td>
                                    <td>{{ $expense->amount }}</td>
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
                            <h5 class="card-title"><i class="fas fa-plus"></i> Add Expense</h5>
                            <button onclick="closeAdd()" class="close" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="col-md-8" style="margin: auto">
                            <form id="addExpense">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Select Expense Head *</label>
                                        <div class="col-sm-8">
                                            <select name="expense_head_id" class="form-control">
                                                <option selected hidden value="">Select expense head</option>
                                                @foreach ($expense_heads as $head)
                                                    <option value="{{ $head->id }}">{{ $head->head_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Expense Name *</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="expense_name" class="form-control" placeholder="Expense name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Invoice Number </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="invoice_no" class="form-control" placeholder="Invoice number">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Date *</label>
                                        <div class="col-sm-8">
                                            <input type="date" name="date" class="form-control" placeholder="Date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Amount *</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="amount" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label class="form-check-label col-sm-4">Description </label>
                                        <div class="col-sm-8">
                                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
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
        $('#addExpense').validate({
           rules: {
               expense_name: {
                   required: true
               },
               date: {
                   required: true
               },
               amount: {
                   required: true
               },
               expense_head_id: {
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
                   url: "{{ route('expense.store') }}",
                   method: "POST",
                   data: new FormData(document.getElementById("addExpense")),
                   enctype: 'multipart/form-data',
                   dataType: 'JSON',
                   contentType: false,
                   cache: false,
                   processData: false,
                   success: function(res) {
                        $("#loading").hide();
                        Swal.fire(
                            'Good job!',
                            'Expense added successfully!',
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
