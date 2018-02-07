<select id="language_selector" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    {% for code, name in config.path('languages') %}
        <option value="{{ url }}/{{ code }}/{{ version }}/{{ page }}"{% if language === code %} selected{% endif %}>
            {{ name }}
        </option>
    {% endfor %}
</select>
