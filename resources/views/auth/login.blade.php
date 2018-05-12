@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Вход в панель управления</div>
        <div class="card-body">
            {!! Form::open(['route' => 'login']) !!}

                {!! Form::token() !!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                    {!! Form::label('name', 'Имя пользователя') !!}

                    {!! Form::text('name', '', ['class' => 'form-control']) !!}

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    {!! Form::label('password', 'Пароль') !!}

                    {!! Form::password('password', ['class' => 'form-control']) !!}

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="form-check">
                        {!! Form::label('remember', Form::checkbox('remember', 1, null, ['class' => 'form-check-input']) . 'Запомнить?', ['class' => 'form-check-label'], false) !!}
                    </div>
                </div>

                {!! Form::button('Войти', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) !!}

            {!! Form::close() !!}
            <div class="text-center">
                {!! Html::link(route('password.request'), 'Забыли пароль?', ['class' => 'd-block small']) !!}
            </div>
        </div>
    </div>
</div>
@endsection
