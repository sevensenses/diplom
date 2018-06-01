@extends('layouts.web')

@section('pagetitle', 'Задать вопрос')

@section('content')
    @if($errors->any()) 
        <div class="alert alert-danger">В форме содержатся ошибки</div>
    @endif

	{!! Form::open(['route' => 'question.store']) !!}
		
		{!! Form::token() !!}

		<div class="form-group row required{{ $errors->has('category_id') ? ' has-error' : '' }}">

			{!! Form::label('category_id', 'Тема вопроса', ['class' => 'col-xs-4 col-form-label']) !!}

			<div class="col-xs-8">

				{!! Form::select('category_id', $categories->pluck('name', 'id'), null, ['class' => 'form-control']) !!}

                @if($errors->has('category_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="form-group row required{{ $errors->has('user_name') ? ' has-error' : '' }}">

			{!! Form::label('user_name', 'Ваше имя', ['class' => 'col-xs-4 col-form-label']) !!}

			<div class="col-xs-8">
				{!! Form::text('user_name', null, ['class' => 'form-control']) !!}

                @if($errors->has('user_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user_name') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="form-group row required{{ $errors->has('user_email') ? ' has-error' : '' }}">

			{!! Form::label('user_email', 'Ваш email', ['class' => 'col-xs-4 col-form-label']) !!}

			<div class="col-xs-8">
				{!! Form::text('user_email', null, ['class' => 'form-control']) !!}

                @if($errors->has('user_email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user_email') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		<div class="form-group row required{{ $errors->has('question') ? ' has-error' : '' }}">
			{!! Form::label('question', 'Ваш вопрос', ['class' => 'col-xs-4 col-form-label']) !!}
		</div>

		<div class="form-group row required{{ $errors->has('question') ? ' has-error' : '' }}">
			<div class="col-xs-12">

				{!! Form::textarea('question', null, ['class' => 'form-control']) !!}

                @if($errors->has('question'))
                    <span class="help-block">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                @endif
			</div>
		</div>

		{!! Form::button('Отправить', ['type' => 'submit', 'class' => 'btn btn-primary pull-right']) !!}
	
	{!! Form::close() !!}
@endsection