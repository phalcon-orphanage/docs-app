{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/meta.volt" with ['name': name, 'description': description, 'keywords': keywords, 'description_long': description_long, 'version': version] -%}
{%- endblock -%}

{%- block content -%}
    {% include "inc/documentation-single.volt" with ['article': article] %}
{%- endblock -%}
