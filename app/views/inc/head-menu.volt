<div class="row">
    <div class="col-md-2 col-sm-3  col-xs-8">
        <div class="header-image__logo-wrapper">
            <a href="/{{ language }}/{{ version }}">
                <img class="logo-img" src="/images/header_logo.svg" alt="logo">
            </a>
        </div>
    </div>
    <div class="col-md-10 col-sm-9 top-menu">

        <div class="nav-icon" onclick="o2.showMobileMenu();">
            <div class="nav-line"></div>
            <div class="nav-line"></div>
            <div class="nav-line"></div>
        </div>
        <nav class="header-nav">
            <ul>
                {%- include "inc/language_selector.volt" -%}
                {%- include "inc/version_selector.volt" -%}
                <li class="nav-item" onclick="o2.toggleState(this, event);">
                    <div class="nav-item_selected">
                        {{ home['community'] }}
                        <span class="caret"></span>
                    </div>
                    <div class="nav-item__list">
                        <a href="https://phalcon.link/forum" class="custom-select__list-item" target="_blank">
                            {{ home['forum'] }}
                        </a>
                        <a href="https://phalcon.link/blog" class="custom-select__list-item" target="_blank">
                            {{ home['blog'] }}
                        </a>
                        <a href="https://phalcon.link/resources" class="custom-select__list-item" target="_blank">
                            {{ home['resources'] }}
                        </a>
                        <div class="nav-item__divider"></div>
                        <a href="https://phalcon.link/f" class="custom-select__list-item" target="_blank">
                            {{ home['facebook'] }}
                        </a>
                        <a href="https://phalcon.link/t" class="custom-select__list-item" target="_blank">
                            {{ home['twitter'] }}
                        </a>
                        <a href="https://phalcon.link/gab" class="custom-select__list-item" target="_blank">
                            {{ home['gab'] }}
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/about">
                        {{ home['about'] }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/sponsors">
                        {{ home['sponsors'] }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/fund">
                        {{ home['support_us'] }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/download">
                        {{ home['download'] }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="header-nav-mobile">
        <div>
            {%- include "inc/language_selector_mobile.volt" -%}
        </div>
        <div>
            {%- include "inc/version_selector_mobile.volt" -%}
        </div>
        <div>
            <div class="nav-item nav-item-accordion" onclick="o2.topicsAccordion(this, event)">
                {{ home['community'] }}
                <span class="caret"></span>
            </div>
            <ul style="display:none;">
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/forum" target="_blank">
                        {{ home['forum'] }}
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/blog" target="_blank">
                        {{ home['blog'] }}
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/resources" target="_blank">
                        {{ home['resources'] }}
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/f" target="_blank">
                        {{ home['facebook'] }}
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/t" target="_blank">
                        {{ home['twitter'] }}
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/gab" target="_blank">
                        {{ home['gab'] }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/about">
                {{ home['about'] }}
            </a>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/sponsors">
                {{ home['sponsors'] }}
            </a>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/fund">
                {{ home['support_us'] }}
            </a>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/download">
                {{ home['download'] }}
            </a>
        </div>
    </div>
</div>
