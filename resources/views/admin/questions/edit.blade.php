@extends('admin.dashboard')

@section('admin-content')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    {{ Breadcrumbs::render('questions.edit', $question) }}
</ol>

{!! Form::open(['route' => ['admin.questions.update', $question->id], 'method' => 'put']) !!}

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

    <div class="form-group row{{ $errors->has('question') ? ' has-error' : '' }}">

        {!! Form::label('question', 'Вопрос', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::text('question', $question->question, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('question'))
            <span class="help-block">
                <strong>{{ $errors->first('question') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('category_id') ? ' has-error' : '' }}">

        {!! Form::label('category_id', 'Категория', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::select('category_id', $categories, $question->category_id, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('user_name') ? ' has-error' : '' }}">

        {!! Form::label('user_name', 'Имя пользователя', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::text('user_name', $question->user_name, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('user_name'))
            <span class="help-block">
                <strong>{{ $errors->first('user_name') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('user_email') ? ' has-error' : '' }}">

        {!! Form::label('user_email', 'E-mail пользователя', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::text('user_email', $question->user_email, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('user_email'))
            <span class="help-block">
                <strong>{{ $errors->first('user_email') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('status_id') ? ' has-error' : '' }}">

        {!! Form::label('status_id', 'Статус', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::select('status_id', $statuses, $question->status_id, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('status_id'))
            <span class="help-block">
                <strong>{{ $errors->first('status_id') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('answer') ? ' has-error' : '' }}">

        {!! Form::label('answer', 'Ответ', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::textarea('answer', $question->answer, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('answer'))
            <span class="help-block">
                <strong>{{ $errors->first('answer') }}</strong>
            </span>
        @endif

    </div>

    <div class="row">
    	<div class="col-4"></div>
		<div class="col-2">
	    {!! Html::link(route('admin.questions.index'), '<i class="fa fa-times"></i>&nbsp;Отмена', ['class' => 'btn btn-danger btn-block'], null, false) !!}
		</div>
		<div class="col-2">
	    {!! Form::button('<i class="fa fa-check"></i>&nbsp;Сохранить', ['type' => 'submit', 'class' => 'btn btn-success btn-block']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection