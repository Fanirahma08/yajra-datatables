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
        
        <h1 class="my-4"> {{$title}} <hr></h1>
            <div class="d-flex justify-content-end mb-4"></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Addres</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                        <tr>
                            <td>{{ $companies->name }}</td>
                            <td>{{ $companies->email }}</td>
                            <td>{{ $companies->addres }}</td>
                            <td>{{ $companies->department }}</td>
                        </tr>
                </table>
            </div>
</body>
</html>
