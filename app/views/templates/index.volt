{{ get_doctype() }}
<!--[if IE 8]>
<html lang="{{ language }}" id="section-reco_main"
      class="nojs iea6 iea7 ie8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ language }}" id="section-reco_main"
      class="nojs iea6 iea7 iea8 ie9 ieb10 split1 nosplit5 platform-PC platform-notouch"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ language }}" class="no-js">
<!--<![endif]-->
<head>
    {%- if (environment('development')) -%}
        {%- set app_version = time() -%}
    {%- else -%}
        {%- set app_version = config.path('app.version', '9999') -%}
    {%- endif -%}


    {%- set name = config.path('app.name', 'Documentation') -%}
    {%- set description = config.path('app.description', 'Phalcon Framework') -%}
    {%- set description_long = config.path('app.descriptionLong', 'Official Phalcon Documentation') -%}
    {%- set url = config.path('app.url', 'https://docs.phalconphp.com') -%}
    {%- set keywords = config.path('app.keywords', 'php, phalcon, phalcon php, php framework, faster php framework') -%}

    {%- block meta -%}{%- endblock -%}

    {%- include "include/ie-support.volt" -%}
    {%- include "include/icons.volt" -%}
    {%- include "include/analytics.volt" -%}

    {%- block head -%}
        {{- assets.outputCss('header_css') -}}
    {%- endblock -%}

    {{- get_title() -}}
</head>
<body onclick="o2.allNavSlideUp()">
{%- include 'inc/header.volt' -%}
{%- include 'inc/advantages.volt' -%}
{%- include 'inc/topics.volt' -%}
{%- include 'inc/support.volt' -%}

{{- assets.outputJs('footer_js') -}}
{%- include 'inc/footer.volt' -%}
<script src="//rum-static.pingdom.net/pa-5c085939db2aac00160001db.js" async></script>
</body>
</html>
