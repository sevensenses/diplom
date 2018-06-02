@extends('admin.dashboard')

@section('admin-content')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    {{ Breadcrumbs::render('users') }}
</ol>

<div class="card mb-3">
<div class="card-header">
	<a href="{{ route('admin.users.create') }}" class="btn btn-success">
		<i class="fa fa-plus"></i>
	</a>
	{{ $pagetitle }}
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
			<th>Имя пользователя</th>
			<th>E-mail</th>
			<th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
			<th>Имя пользователя</th>
			<th>E-mail</th>
			<th></th>
        </tr>
      </tfoot>
      <tbody>
      	@foreach($users as $user)
			<tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					{!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}

    					{!! Form::token() !!}

						<a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}">
							<i class="fa fa-edit"></i>
						</a>

						{!! Form::button('<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
						
					{!! Form::close() !!}
				</td>
			</tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@endsection