{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/meta.volt" with ['name': name, 'description': description, 'keywords': keywords, 'description_long': description_long] -%}
{%- endblock -%}

{%- block sidebar -%}
    {%- include "include/language_selector.volt" -%}
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    {{ article }}
{%- endblock -%}
