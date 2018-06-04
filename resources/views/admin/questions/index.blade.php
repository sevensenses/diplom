@extends('admin.dashboard')

@section('admin-content')

<div class="card mb-3">
<div class="card-header">
	<a href="{{ route('admin.questions.create') }}" class="btn btn-success">
		<i class="fa fa-plus"></i>
	</a>
	{{ $pagetitle }}
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
			<th>Вопрос</th>
			<th>Категория</th>
			<th>Статус</th>
			<th>Дата создания</th>
			<th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
			<th>Вопрос</th>
			<th>Категория</th>
			<th>Статус</th>
			<th>Дата создания</th>
			<th></th>
        </tr>
      </tfoot>
      <tbody>
      	@foreach($questions as $question)
			<tr>
				<td>{{ $question->question }}</td>
				<td>{{ $question->category->name }}</td>
				<td>{{ $question->status->name }}</td>
				<td>{{ $question->created_at }}</td>
				<td>
					{!! Form::open(['route' => ['admin.questions.destroy', $question->id], 'method' => 'delete']) !!}

    					{!! Form::token() !!}

						<a class="btn btn-primary" href="{{ route('admin.questions.edit', $question->id) }}">
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