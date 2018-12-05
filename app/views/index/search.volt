{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/meta.volt" with [
        'url': url,
        'name': name,
        'language': language,
        'description': description,
        'keywords': keywords,
        'description_long': description_long,
        'app_version': app_version
    ] -%}
{%- endblock -%}

{%- block content -%}
    {% include "inc/search-block.volt" %}
{%- endblock -%}
