<!DOCTYPE html>

<html>

<head>

    <title>Employee List</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>

    

<div class="container">

    <h1>Laravel 6 Ajax CRUD tutorial using Datatable - ItSolutionStuff.com</h1>

    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>

    <table class="table table-bordered data-table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Address</th>
                <th>Mobile</th>
                <th>position</th>

                <th width="280px">Action</th>

            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

</div>

   

<div class="modal fade" id="ajaxModel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>

            </div>

            <div class="modal-body">

                <form id="productForm" name="productForm" class="form-horizontal">

                   <input type="hidden" name="product_id" id="product_id">

                    <div class="form-group">

                        <label for="name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-12">

                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">

                        </div>

                    </div>

     

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Address</label>

                        <div class="col-sm-12">

                            <textarea id="address" name="address" required="" placeholder="address" class="form-control"></textarea>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="name" class="col-sm-2 control-label">Mobile</label>

                            <div class="col-sm-12">

                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" value="" maxlength="50" required="">

                            </div>

                    </div>
                    <div class="form-group">

<label for="name" class="col-sm-2 control-label">Position</label>

<div class="col-sm-12">

    <input type="text" class="form-control" id="position" name="position" placeholder="Enter position" value="" maxlength="50" required="">

</div>

</div>

      

                    <div class="col-sm-offset-2 col-sm-10">

                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes

                     </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

    

</body>

    

<script type="text/javascript">

  $(function () {

     

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    

    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('employees.index') }}",

        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex'},

            {data: 'name', name: 'name'},

            {data: 'address', name: 'address'},

            {data: 'mobile', name: 'mobile'},

            {data: 'position', name: 'position'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });

     

    $('#createNewProduct').click(function () {

        $('#saveBtn').val("create-product");

        $('#product_id').val('');

        $('#productForm').trigger("reset");

        $('#modelHeading').html("Create New Product");

        $('#ajaxModel').modal('show');

    });

    

    $('body').on('click', '.editProduct', function () {

      var employee_id = $(this).data('id');

      $.get("{{ route('employees.index') }}" +'/' + employee_id +'/edit', function (data) {

          $('#modelHeading').html("Edit Product");

          $('#saveBtn').val("edit-user");

          $('#ajaxModel').modal('show');

          $('#employee_id').val(data.id);

          $('#name').val(data.name);

          $('#address').val(data.address);

          $('#mobile').val(data.mobile);

          $('#position').val(data.position);

      })

   });

    

    $('#saveBtn').click(function (e) {

        e.preventDefault();

        $(this).html('Sending..');

    

        $.ajax({

          data: $('#productForm').serialize(),

          url: "{{ route('employees.store') }}",

          type: "POST",

          dataType: 'json',

          success: function (data) {

     

              $('#productForm').trigger("reset");

              $('#ajaxModel').modal('hide');

              table.draw();

         

          },

          error: function (data) {

              console.log('Error:', data);

              $('#saveBtn').html('Save Changes');

          }

      });

    });

    

    $('body').on('click', '.deleteProduct', function () {

     

        var employee_id = $(this).data("id");

        confirm("Are You sure want to delete !");

      

        $.ajax({

            type: "DELETE",

            url: "{{ route('employees.store') }}"+'/'+employee_id,

            success: function (data) {

                table.draw();

            },

            error: function (data) {

                console.log('Error:', data);

            }

        });

    });

     

  });

</script>

</html>