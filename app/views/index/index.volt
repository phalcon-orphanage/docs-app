<!doctype html>
<!--[if IE 8]>
<html lang="{{ language }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ language }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ language }}" class="no-js">
<!--<![endif]-->
<head>
    {%- set name = config.get('app').get('name', 'Phalcon Documentation') -%}
    {%- set description = config.get('app').get('description', 'Official Phalcon Documentation') -%}
    {%- set website_url = config.get('app').get('url', url()) -%}

    {%- include "include/meta.volt" with ['name': name, 'description': description] -%}
    {%- include "include/icons.volt" with ['website_url': website_url] -%}
    {%- include "include/analytics.volt" -%}

    {{- assets.outputCss('header_css') -}}

    <title>
        {{ name ~ ' - ' ~ description}}
    </title>
</head>

<body class="with-top-navbar">
{%- include 'include/nav.volt' -%}
<div class="container-fluid article-page-wrap">
    <div class="row">
        <div class="col-md-2 sidebar hidden-xs">
            <select id="language_selector"
                    class="form-control"
                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                {% for label, text in config.path('languages') %}
                <option value="/{{ label }}/{{ version }}{{ slug }}"{% if language === label %} selected{% endif %}>
                    {{ text }}
                </option>
                {% endfor %}
            </select>
            <br>
            {{ sidebar }}
        </div>
        <div class="m-t-md m-b-lg" id="articles">
            <div class="article-content">
                {{ article }}
            </div>
        </div>
        {%- include "include/footer.volt" -%}
    </div>
</div>

{{- assets.outputJs('footer_js') -}}

<script type="application/javascript">hljs.initHighlightingOnLoad();</script>
</body>
</html>
