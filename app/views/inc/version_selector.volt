<li class="nav-item" onclick="o2.toggleState(this, event);">
	<div class="nav-item__selected custom-select__version">
		Version {{ version }}
		<span class="caret"></span>
	</div>
	<div class="nav-item__list" onclick="event.stopPropagation();">
		{% for versionItem in config.path('versions') %}
			<a href="{{ url }}/{{ language }}/{{ versionItem }}/{{ page }}" class="custom-select__list-item">
				<span>{{ versionItem }}</span>
			</a>
		{% endfor %}
	</div>
</li>