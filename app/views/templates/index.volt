{{ get_doctype() }}
<!--[if IE 8]>
<html lang="{{ language }}" id="section-reco_main" class="nojs iea6 iea7 ie8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ language }}" id="section-reco_main" class="nojs iea6 iea7 iea8 ie9 ieb10 split1 nosplit5 platform-PC platform-notouch"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ language }}" class="no-js">
<!--<![endif]-->
<head>
    {%- if (environment('development')) -%}
        {%- set app_version = time() -%}
    {%- else -%}
        {%- set app_version = config('app.version', '9999') -%}
    {%- endif -%}


    {%- set name = config.get('app').get('name', 'Documentation') -%}
    {%- set description = config.get('app').get('description', 'Phalcon Framework') -%}
    {%- set description_long = config.get('app').get('descriptionLong', 'Official Phalcon Documentation') -%}
    {%- set url = config.get('app').get('url', 'https://docs.phalconphp.com') -%}
    {%- set keywords = config.get('app').get('keywords', 'php, phalcon, phalcon php, php framework, faster php framework') -%}

    {%- block meta -%}{%- endblock -%}

    {%- include "include/ie-support.volt" with ['app_version': app_version] -%}
    {%- include "include/icons.volt" with ['url': url] -%}
    {%- include "include/analytics.volt" -%}

    {%- block head -%}
        {{- assets.outputCss('header_css') -}}
    {%- endblock -%}

    {{-  get_title() -}}
</head>
<body  onclick="o2.allNavSlideUp()">
    {%- include 'inc/header.volt' -%}
    {%- include 'inc/advantages.volt' with ['url': url, 'language': language] -%}
    {%- include 'inc/topics.volt' -%}
    {%- include 'inc/support.volt' -%}

    {{- assets.outputJs('footer_js') -}}
    {%- include 'inc/footer.volt' -%}
</body>
</html>
