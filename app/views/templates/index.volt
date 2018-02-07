{{ get_doctype() }}
<!--[if IE 7]>
<html lang="{{ language }}" id="section-reco_main" class="nojs iea6 ie7 ieb8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"> <![endif]-->
<!--[if IE 8]>
<html lang="{{ language }}" id="section-reco_main" class="nojs iea6 iea7 ie8 ieb9 ieb10 split1 nosplit5 platform-PC platform-notouch"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ language }}" id="section-reco_main" class="nojs iea6 iea7 iea8 ie9 ieb10 split1 nosplit5 platform-PC platform-notouch"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ language }}" class="no-js">
<!--<![endif]-->
<head>
    <meta name="viewport" content="width=device-width">
    <meta name="MobileOptimized" content="320"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta charset="utf-8">
    <meta name="viewport min-width=320px" content="min-width=320, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script type="text/javascript" src="/js/main.min.js"></script>
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
    <script type="text/javascript" src="/js/libs/flexibility.min.js"></script>
    <script type="text/javascript" src="/js/libs/flexie.js"></script>
    <![endif]-->
    {%- set name = config.get('app').get('name', 'Documentation') -%}
    {%- set description = config.get('app').get('description', 'Phalcon Framework') -%}
    {%- set description_long = config.get('app').get('descriptionLong', 'Official Phalcon Documentation') -%}
    {%- set url = config.get('app').get('url', 'https://docs.phalconphp.com') -%}
    {%- set keywords = config.get('app').get('keywords', 'php, phalcon, phalcon php, php framework, faster php framework') -%}

    {%- block meta -%}{%- endblock -%}
    {%- include "include/icons.volt" with ['url': url] -%}
    {%- include "include/analytics.volt" -%}

    {{  get_title() }}
</head>
<body  onclick="o2.allNavSlideUp()">
    {% include 'inc/header.volt' %}
    {% include 'inc/advantages.volt' %}
    {% include 'inc/topics.volt' %}
    {% include 'inc/support.volt' %}
    {% include 'inc/footer.volt' %}
</body>
</html>
