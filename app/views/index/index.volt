{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/meta.volt" with ['name': name, 'description': description, 'keywords': keywords] -%}
{%- endblock -%}

{%- block title -%}
    {{ config.get('app').get('name', 'Phalcon Documentation') }}
{%- endblock -%}

{%- block sidebar -%}
    {%- include "include/language_selector.volt" -%}
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    {{ article }}
{%- endblock -%}
