<header class="header-image">
    <div class="container">
        <div class="header-wrapper">
            <div class="clearfix">
                {% include 'inc/head-menu.volt' %}
            </div>
            <div class="header-description" itemscope itemtype="https://schema.org/Thing">
                <h1 class="h1_style" itemprop="description">
                    <span itemprop="name">Phalcon</span> {{ homeArray[19] }}
                </h1>
                <p>
                    {{ homeArray[20] }}
                </p>
                <div class="header-search">
                    {% include 'inc/gse-inner.volt' %}
                </div>
                <a href="https://phalcon.link/github" class="link__github" target="_blank">
                    {{ homeArray[16] }}
                    <div class="link__circle-arrow">
                        <div class="link__arrow"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</header>
