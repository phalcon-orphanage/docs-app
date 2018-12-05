{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/noindex-meta.volt" -%}
{%- endblock -%}

{%- block sidebar -%}
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    <section class="documentation-section">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-8 col-lg-9 parse-content">
                    <div>
                        <p class="lead">
                            {{ homeArray[44] }} <a href="{{ 'mailto:' ~ support }}">{{ support }}</a>.
                            {{ homeArray[45] }}
                            Please check back in a few minutes!
                        </p>
                    </div>
                    {{- article -}}
                </div>
                <div class="col-md-4 col-lg-3 col-sm-12 support-column-margin">
                    <p class="text-right"><em>&mdash; {{ homeArray[38] }}</em></p>
                </div>
            </div>
        </div>
    </section>
{%- endblock -%}
