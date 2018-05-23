@extends('admin.dashboard')

@section('admin-content')

{!! Form::open(['route' => ['admin.users.update', $user->id], 'method' => 'put']) !!}

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

    <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">

        {!! Form::label('name', 'Имя пользователя', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">

        {!! Form::label('email', 'E-mail', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">

        {!! Form::label('password', 'Пароль', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('change_password') ? ' has-error' : '' }}">

        {!! Form::label('change_password', 'Сменить пароль?', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::hidden('change_password', 0) !!}
            {!! Form::checkbox('change_password', 1, 0) !!}
        </div>

        @if ($errors->has('change_password'))
            <span class="help-block">
                <strong>{{ $errors->first('change_password') }}</strong>
            </span>
        @endif

    </div>

    <div class="row">
    	<div class="col-4"></div>
		<div class="col-2">
	    {!! Html::link(route('admin.users.index'), '<i class="fa fa-times"></i>&nbsp;Отмена', ['class' => 'btn btn-danger btn-block'], null, false) !!}
		</div>
		<div class="col-2">
	    {!! Form::button('<i class="fa fa-check"></i>&nbsp;Сохранить', ['type' => 'submit', 'class' => 'btn btn-success btn-block']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection