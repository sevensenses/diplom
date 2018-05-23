@extends('admin.dashboard')

@section('admin-content')
<div class="card mb-3">
<div class="card-header">
	<a href="{{ route('admin.categories.create') }}" class="btn btn-success">
		<i class="fa fa-plus"></i>
	</a>
	{{ $pagetitle }}
</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
			<th>Название</th>
			<th>Новых вопросов</th>
			<th>Скрытых вопросов</th>
			<th>Всего вопросов</th>
			<th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
			<th>Название</th>
			<th>Новых вопросов</th>
			<th>Скрытых вопросов</th>
			<th>Всего вопросов</th>
			<th></th>
        </tr>
      </tfoot>
      <tbody>
      	@foreach($categories as $category)
			<tr>
				<td>{{ $category->name }}</td>
				<td>
					<a href="{{ route('admin.categories.questions.new', $category->id) }}">
						{{ $category->new_questions_count }}
					</a>
				</td>
				<td>
					<a href="{{ route('admin.categories.questions.hidden', $category->id) }}">
						{{ $category->hidden_questions_count }}
					</a>
				</td>
				<td>
					<a href="{{ route('admin.categories.questions.index', $category->id) }}">
						{{ $category->questions_count }}
					</a>
				</td>
				<td>
					{!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete']) !!}

    					{!! Form::token() !!}

						<a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}">
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