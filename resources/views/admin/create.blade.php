@extends('admin.dashboard')

@section('admin-content')

{!! Form::open(['route' => ['admin.create', 'model' => $model]]) !!}

    {!! Form::token() !!}

    @foreach($fields as $field)
    <div class="form-group row{{ $errors->has($field['name']) ? ' has-error' : '' }}">

	    {!! Form::label($field['name'], $field['title'], ['class' => 'col-4 col-form-label']) !!}

	    <div class="col-8">
        @switch($field['type'] ?? 'text')

        	@case('checkbox')
        		
                {!! Form::hidden($field['name'], 0) !!}
        		{!! Form::checkbox($field['name']) !!}

        	@break

        	@case('select')
        		
        		{!! Form::select($field['name'], $field['values'], null, ['class' => 'form-control']) !!}

        	@break

        	@case('textarea')

        		{!! Form::textarea($field['name'], null, ['class' => 'form-control']) !!}
        		
        	@break

        	@default

        		{!! Form::text($field['name'], null, ['class' => 'form-control']) !!}

        @endswitch

        @if ($errors->has($field['name']))
            <span class="help-block">
                <strong>{{ $errors->first($field['name']) }}</strong>
            </span>
        @endif
   		</div>
    </div>
    @endforeach

    <div class="row">
    	<div class="col-4"></div>
		<div class="col-2">
	    {!! Html::link(url()->previous(), '<i class="fa fa-times"></i>&nbsp;Отмена', ['class' => 'btn btn-danger btn-block'], null, false) !!}
		</div>
		<div class="col-2">
	    {!! Form::button('<i class="fa fa-check"></i>&nbsp;Сохранить', ['type' => 'submit', 'class' => 'btn btn-success btn-block']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection