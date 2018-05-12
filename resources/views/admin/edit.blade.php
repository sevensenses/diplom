@extends('admin.dashboard')

@section('admin-content')

{!! Form::open(['route' => ['admin.edit', 'model' => $model, 'id' => $id]]) !!}

    {!! Form::token() !!}

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            В форме содержатся ошибки
        </div>
    @endif

    @foreach($fields as $field)
    <div class="form-group row{{ $errors->has($field['name']) ? ' has-error' : '' }}">

	    {!! Form::label($field['name'], $field['title'], ['class' => 'col-4 col-form-label']) !!}

	    <div class="col-8">
        @switch($field['type'] ?? 'text')

        	@case('checkbox')
        		
                {!! Form::hidden($field['name'], 0) !!}
        		{!! Form::checkbox($field['name'], 1, $field['value']) !!}

        	@break

        	@case('select')
        		
        		{!! Form::select($field['name'], $field['values'], $field['value'], ['class' => 'form-control']) !!}

        	@break

            @case('textarea')

                {!! Form::textarea($field['name'], $field['value'], ['class' => 'form-control']) !!}
                
            @break

        	@default

        		{!! Form::text($field['name'], $field['value'], ['class' => 'form-control']) !!}

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
	    {!! Html::link(route('admin.list', ['model' => $model]), '<i class="fa fa-times"></i>&nbsp;Отмена', ['class' => 'btn btn-danger btn-block'], null, false) !!}
		</div>
		<div class="col-2">
	    {!! Form::button('<i class="fa fa-check"></i>&nbsp;Сохранить', ['type' => 'submit', 'class' => 'btn btn-success btn-block']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection