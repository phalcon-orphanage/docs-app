{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/noindex-meta.volt" with ['app_version': app_version] -%}
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
                            {{ homeArray[37] }}:
                            <a href="{{ 'mailto:' ~ support }}">{{ support }}</a>
                        </p>
                        <p>
                            <a class="btn btn-primary" href="/" style="color: #fff;">{{ homeArray[38] }}</a>
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
