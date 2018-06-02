@extends('admin.dashboard')

@section('admin-content')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    {{ Breadcrumbs::render('categories.edit', $category) }}
</ol>

{!! Form::open(['route' => ['admin.categories.update', $category->id], 'method' => 'put']) !!}

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

        {!! Form::label('name', 'Название', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group row{{ $errors->has('active') ? ' has-error' : '' }}">

        {!! Form::label('active', 'Включена?', ['class' => 'col-4 col-form-label']) !!}

        <div class="col-8">
            {!! Form::hidden('active', 0) !!}
            {!! Form::checkbox('active', 1, $category->active) !!}
        </div>

        @if ($errors->has('active'))
            <span class="help-block">
                <strong>{{ $errors->first('active') }}</strong>
            </span>
        @endif

    </div>

    <div class="row">
    	<div class="col-4"></div>
		<div class="col-2">
	    {!! Html::link(route('admin.categories.index'), '<i class="fa fa-times"></i>&nbsp;Отмена', ['class' => 'btn btn-danger btn-block'], null, false) !!}
		</div>
		<div class="col-2">
	    {!! Form::button('<i class="fa fa-check"></i>&nbsp;Сохранить', ['type' => 'submit', 'class' => 'btn btn-success btn-block']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection