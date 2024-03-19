<!DOCTYPE html>
<html lang="en">
<head>
    <title>Yajra Datatables</title>
    
    <!-- bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
 
<body>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 12pt;
		}
	</style>
              
                        <h1 class="my-4">Employee Data <hr></h1>
                         <div class="d-flex justify-content-end mb-4">
        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Addres</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                             @foreach($companies ?? '' as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->addres }}</td>
                    <td>{{ $data->department }}</td>
                </tr>
                @endforeach
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <!-- <script type="text/javascript">
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

                ],
                order: [[0, 'asc']]
            });

        });

    </script> -->
</body>
</html>
