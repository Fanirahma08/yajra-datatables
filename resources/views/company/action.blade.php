 
<a href="{{ route('company.edit',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success edit">
Edit
</a>
<a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
Delete
</a>
<a href="{{ URL::to('/company/exportId', $id)}}" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Export" class="export btn btn-secondary">
Download
</a>