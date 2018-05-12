@extends('layouts.app')

@section('body')
<header>
    <h1>@yield('pagetitle', env('APP_NAME'))</h1>
</header>
<section class="cd-faq">
    <ul class="cd-faq-categories">
    @foreach($menu as $item)
        <li><a href="#menu-{{ $item->id }}">{{ $item->name }}</a></li>
    @endforeach
        <li><a href="{{ route('question.add') }}" onclick="location.href=this.href">Задать вопрос</a></li>
    </ul> <!-- cd-faq-categories -->

    <div class="cd-faq-items">
        @yield('content')
    </div> <!-- cd-faq-items -->
    @yield('content.second')
</section> <!-- cd-faq -->
@endsection
