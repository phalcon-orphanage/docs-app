{%- extends "templates/base.volt" -%}

{%- block meta -%}
    {%- include "include/noindex-meta.volt" -%}
{%- endblock -%}

{%- block sidebar -%}
    {{ sidebar }}
{%- endblock -%}

{%- block content -%}
    <section class="documentation-section">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1 parse-content">
                    <div>
                        <p class="lead">
                            {{ home['apologize'] }} <a href="{{ 'mailto:' ~ support }}">{{ support }}</a>.
                            {{ home['check_back_later'] }}
                        </p>
                        <p>
                            <br />
                            <a class="btn btn-primary" href="{{ url ~ '?from=error500' }}">{{ home['back_to_main_page'] }}</a>
                        </p>
                    </div>
                    {{- article -}}
                </div>
            </div>
        </div>
    </section>
{%- endblock -%}
