<header class="header-image">
    <div class="container">
        <div class="header-wrapper">
            <div class="clearfix">
                {% include 'inc/head-menu.volt' %}
            </div>
            <div class="header-description" itemscope itemtype="https://schema.org/Thing">
                <h1 class="h1_style" itemprop="description">
                    <span itemprop="name">Phalcon</span> {{ home['feature_rich'] }}
                </h1>
                <p>
                    {{ home['innovative_architecture'] }}
                </p>
                <div class="header-search">
                    {% include 'inc/gse-inner.volt' %}
                </div>
                <a href="https://phalcon.link/github" class="link__github" target="_blank">
                    {{ home['github'] }}
                    <div class="link__circle-arrow">
                        <div class="link__arrow"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</header>
