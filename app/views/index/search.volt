{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/meta.volt" -%}
{%- endblock -%}

{%- block content -%}
    {% include "inc/search-block.volt" %}
{%- endblock -%}
