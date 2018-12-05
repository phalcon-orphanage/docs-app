{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/meta.volt" with [
        'url': url,
        'language': language,
        'name': name,
        'description': description,
        'keywords': keywords,
        'description_long': description_long,
        'app_version': app_version
    ] -%}
{%- endblock -%}

{%- block content -%}
    {% include "inc/documentation-single.volt" with ['article': article] %}
{%- endblock -%}
