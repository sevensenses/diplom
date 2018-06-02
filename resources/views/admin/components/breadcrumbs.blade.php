@foreach($breadcrumbs as $breadcrumb) 
	<li class="breadcrumb-item">
		<a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
	</li>
@endforeach