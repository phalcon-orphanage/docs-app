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
                        Community
                        <span class="caret"></span>
                    </div>
                    <div class="nav-item__list">
                        <a href="https://phalcon.link/forum" class="custom-select__list-item" target="_blank">
                            Forum
                        </a>
                        <a href="https://phalcon.link/blog" class="custom-select__list-item" target="_blank">
                            Blog
                        </a>
                        <a href="https://phalcon.link/resources" class="custom-select__list-item" target="_blank">
                            Resources
                        </a>
                        <div class="nav-item__divider"></div>
                        <a href="https://phalcon.link/f" class="custom-select__list-item" target="_blank">
                            Facebook
                        </a>
                        <a href="https://phalcon.link/t" class="custom-select__list-item" target="_blank">
                            Twitter
                        </a>
                        <a href="https://phalcon.link/g+" class="custom-select__list-item" target="_blank">
                            Google+
                        </a>
                        <a href="https://phalcon.link/gab" class="custom-select__list-item" target="_blank">
                            Gab.ai
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/about">
                        About
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/sponsors">
                        Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/fund">
                        Support Us
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://phalcon.link/download">
                        Download
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
                Community
                <span class="caret"></span>
            </div>
            <ul style="display:none;">
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/forum" target="_blank">
                        Forum
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/blog" target="_blank">
                        Blog
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/resources" target="_blank">
                        Resources
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/f" target="_blank">
                        Facebook
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/t" target="_blank">
                        Twitter
                    </a>
                </li>
                <li class="nav-item nav-item-li">

                    <a href="https://phalcon.link/g+" target="_blank">
                        Google+
                    </a>
                </li>
                <li class="nav-item nav-item-li">
                    <a href="https://phalcon.link/gab" target="_blank">
                        Gab.ai
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/about">
                About
            </a>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/sponsors">
                Blog
            </a>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/fund">
                Support Us
            </a>
        </div>
        <div class="nav-item">
            <a href="https://phalcon.link/download">
                Download
            </a>
        </div>
    </div>
</div>
