@extends('admin.dashboard')

@section('admin-content')
<div class="card mb-3">
<div class="card-header">
	<a href="{{ route('admin.create', ['model' => $model]) }}" class="btn btn-success">
		<i class="fa fa-plus"></i>
	</a>
	{{ $pagetitle }}
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
			@foreach($tableHeaders as $header)
				<th>{{ $header }}</th>
			@endforeach
			<th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
			@foreach($tableHeaders as $header)
				<th>{{ $header }}</th>
			@endforeach
			<th></th>
        </tr>
      </tfoot>
      <tbody>
      	@foreach($tableRows as $id => $row)
			<tr>
				@foreach($row as $column)
					<td>{!! $column !!}</td>
				@endforeach
				<td>
					<a class="btn btn-primary" href="{{ route('admin.edit', ['model' => $model, 'id' => $id]) }}">
						<i class="fa fa-edit"></i>
					</a>
					<a class="btn btn-danger" href="{{ route('admin.remove', ['model' => $model, 'id' => $id]) }}">
						<i class="fa fa-times"></i>
					</a>
				</td>
			</tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection