{{ get_doctype() }}
<!--[if IE 8]>
<html lang="{{ language }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ language }}" class="ie9 no-js"> <![endif]-->
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
    {%- include "include/icons.volt" -%}
    {%- include "include/analytics.volt" -%}

    {%- block head -%}
        {{- assets.outputCss('header_css') -}}
    {%- endblock -%}

    {{- get_title() -}}
</head>

<body onclick="o2.allNavSlideUp()">
{%- include 'inc/header-inner.volt' -%}

<div class="container-fluid article-page-wrap">
    <div class="row">
        <div>
            <div class="col-md-2 sidebar hidden-xs">
                <div class="sidebar--spacer">&nbsp;</div>
            </div>
            <div class="m-t-md m-b-lg" id="articles">
                <div class="article-content">
                    {%- block content -%}{%- endblock -%}
                </div>
            </div>
        </div>
    </div>
</div>

{%- include 'inc/footer.volt' -%}
{{- assets.outputJs('footer_js') -}}
<script type="application/javascript">hljs.initHighlightingOnLoad();</script>
</body>
</html>
