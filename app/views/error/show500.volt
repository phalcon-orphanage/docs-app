{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/noindex-meta.volt" -%}
{%- endblock -%}

{%- block sidebar -%}
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    <p class="lead">
        Sorry for the inconvenience but something is not quite right at the moment.
        We hope to solve it shortly. If you need to you can always contact us at
        <a href="{{ 'mailto:' ~ support }}">{{ support }}</a>,
        otherwise please check back in a few minutes!
    </p>

    {{- article -}}

    <p class="text-right"><em>&mdash; The Phalcon Team</em></p>
{%- endblock -%}
