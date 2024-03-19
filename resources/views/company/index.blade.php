<!DOCTYPE html>
<html lang="en">
<head>
    <title>Yajra Datatables</title>
    
    <!-- bootstrap -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</head>
 
<body style="background: lightgray">
    <div class="container">
        <div class="row justify-content-center">
                <div class="card mt-5">
                    <div class="card-body">
                        <!-- <h3 class="my-4">Employee Data &nbsp;&nbsp;<a class="btn btn-primary" href="{{ route('company.create') }}">Add Employee</a><hr></h3> -->
                         <h3 class="my-4">Employee Data &nbsp;&nbsp;<a class="btn btn-primary" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Employee</a><hr></h3>
                        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary" href="{{ URL::to('/company/exportPDF') }}">Export to PDF</a>
        </div>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <table class="table table-bordered" id="datatable-crud">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Addres</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form 
            class="w-px-500 p-3 p-md-3 needs-validation" 
            action="{{ route('company.store') }}" 
            method="post"
            role="form"
            novalidate
        >
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Data Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card-body">                    
                <div class="row mb-3 form-group">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="name" 
                            placeholder="Add Name"
                            required
                        >
                    </div>
                </div>
                <div class="row mb-3 form-group">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input 
                            type="email" 
                            class="form-control" 
                            name="email" 
                            placeholder="Add Email"
                            required
                        >
                    </div>
                </div>
               <div class="row mb-3 form-group">
                    <label class="col-sm-3 col-form-label">Addres</label>
                    <div class="col-sm-9">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="addres" 
                            placeholder="Add Addres"
                            required
                        >
                    </div>
                </div>
                <div class="row mb-3 form-group">
                    <label class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                        <input 
                            type="text" 
                            class="form-control" 
                            name="department" 
                            placeholder="Add Department"
                            required
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datatable-crud').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('company') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'addres', name: 'addres' },
                    { data: 'department', name: 'department' },                    
                    { data: 'action', name: 'action', orderable: false},

                ],
                order: [[0, 'asc']]
            });

            $('body').on('click', '.delete', function () {
                if (confirm("Delete Record?") == true) {
                    var id = $(this).data('id');
                    // ajax
                    $.ajax({
                        type:"POST",
                        url: "{{ url('delete-company') }}",
                        data: { id: id},
                        dataType: 'json',
                        success: function(res){
                            var oTable = $('#datatable-crud').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                }
            });
        });

    </script>
</body>
</html>
