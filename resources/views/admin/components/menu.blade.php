<li class="nav-item" data-toggle="tooltip" data-placement="right" title="{{ $item['name'] }}">
	<a class="nav-link" href="{{ $item['url'] }}">
		<i class="{{ $item['icon'] }}"></i>
		<span class="nav-link-text">{{ $item['name'] }}</span>
	</a>

	@isset($item['childs']) 
	<ul class="sidenav-second-level collapse" id="collapseComponents">
		@foreach($item['childs'] as $child)
			<li>
				<a href="{{ $child['url'] }}">{{ $child['name'] }}</a>
			</li>
		@endforeach
	</ul>
	@endisset
</li>