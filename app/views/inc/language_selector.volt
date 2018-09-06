<li class="nav-item" onclick="o2.toggleState(this, event);">
    <div class="nav-item_selected">
        <img src="/images/flags/{{ language }}.gif">
        <span class="caret"></span>
    </div>
    <div class="nav-item__list" onclick="event.stopPropagation();">
        {% for code, name in config.path('languages') %}
            <a href="{{ url }}/{{ code }}/{{ version }}/{{ page }}" class="custom-select__list-item">
                <img src="/images/flags/{{ code }}.gif" alt="">
                <span>{{ name }}</span>
            </a>
        {% endfor %}
    </div>
</li>
