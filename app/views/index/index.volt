{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/meta.volt" with ['name': name, 'description': description, 'keywords': keywords] -%}
{%- endblock -%}

{%- block title -%}
    {{ config.get('app').get('name', 'Phalcon Documentation') }}
{%- endblock -%}

{%- block sidebar -%}
    <select id="language_selector"
            class="form-control"
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        {% for label, text in config.path('languages') %}
            <option value="/{{ label }}/{{ version }}{{ slug }}"{% if language === label %} selected{% endif %}>
                {{ text }}
            </option>
        {% endfor %}
    </select>
    <br>
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    {{ article }}
{%- endblock -%}
