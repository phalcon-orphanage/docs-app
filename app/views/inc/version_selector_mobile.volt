<div class="nav-item nav-item-accordion" onclick="o2.topicsAccordion(this,event)">
    Version {{ version }}
    <span class="caret"></span>
</div>

<ul style="display:none;" class="clearfix" onclick="event.stopPropagation();">
    {% for versionItem in config.path('versions') %}
        <li class="nav-item nav-item-li col-xs-12">
            <a href="{{ url }}/{{ language }}/{{ versionItem }}/{{ page }}">
                <span>{{ versionItem }}</span>
            </a>
        </li>
    {% endfor %}
</ul>
