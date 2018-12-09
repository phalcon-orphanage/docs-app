{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/noindex-meta.volt" -%}
{%- endblock -%}

{%- block sidebar -%}
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    <section class="documentation">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1 parse-content">
                    <div>
                        <p class="lead">
                            {{ homeArray[37] }}:
                            <a href="{{ 'mailto:' ~ support }}">{{ support }}</a>
                        </p>
                        <p>
                            <br />
                            <a class="btn btn-primary" href="{{ url ~ '?from=error404' }}">{{ homeArray[38] }}</a>
                        </p>
                    </div>
                    {{- article -}}
                </div>
            </div>
        </div>
    </section>
{%- endblock -%}
