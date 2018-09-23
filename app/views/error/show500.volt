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
                            We apologise for the inconvenience. It seems something
                            is not quite right at the moment. We hope to solve it
                            shortly. If you need to you can always contact us at
                            <a href="{{ 'mailto:' ~ support }}">{{ support }}</a>,
                            otherwise please check back in a few minutes!
                        </p>
                    </div>
                    {{- article -}}
                </div>
                <div class="col-md-4 col-lg-3 col-sm-12 support-column-margin">
                    <p class="text-right"><em>&mdash; The Phalcon Team</em></p>
                </div>
            </div>
        </div>
    </section>
{%- endblock -%}
