@extends('layouts.web')

@section('content')
    @foreach($categories as $category)
        <ul id="menu-{{ $category->id }}" class="cd-faq-group">
            <li class="cd-faq-title"><h2>{{ $category->name }}</h2></li>
            @foreach($category->questions as $question)
            <li>
                <a class="cd-faq-trigger" href="#0">{{ $question->question }}</a>
                <div class="cd-faq-content">
                    {!! $question->answer !!}
                </div> <!-- cd-faq-content -->
            </li>
            @endforeach
        </ul> <!-- cd-faq-group -->
    @endforeach
@endsection

@section('content.second')
    <a href="#0" class="cd-close-panel">Close</a>
@endsection