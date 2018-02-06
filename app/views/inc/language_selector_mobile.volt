<div class="nav-item nav-item-accordion" onclick="o2.topicsAccordion(this, event)">
	<img src="/images/flags/{{ language }}.gif">
	<span class="caret"></span>
</div>

<ul style="display:none;" class="clearfix" onclick="event.stopPropagation();">
	{%- for code, name in config.path('languages') -%}
	<li class="nav-item nav-item-li col-sm-3 col-xs-6">
	<a href="{{ url }}/{{ code }}/{{ version }}/{{ page }}">
		<img src="/images/flags/{{ code }}.gif" alt="">
		<span>{{ name}}</span>
	</a>
	</li>
	{%- endfor -%}
</ul>
