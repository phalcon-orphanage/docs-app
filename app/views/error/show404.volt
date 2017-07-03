{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/noindex-meta.volt" -%}
{%- endblock -%}

{%- block sidebar -%}
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    <p class="lead">
        Oops! It seems you made a mistake by typing the wrong address or something like that.
        In any case, please let us know:
        <a href="{{ 'mailto:' ~ support }}">{{ support }}</a>
    </p>
    <p>
        <a class="btn btn-primary" href="/" style="color: #fff;">Back to main page</a>
    </p>

    {{- article -}}

    <p class="text-right"><em>&mdash; The Phalcon Team</em></p>
{%- endblock -%}
