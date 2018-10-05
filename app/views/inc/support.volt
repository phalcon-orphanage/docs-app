<section class="support-section">
    <div class="container">
        <div class="support-wrapper">
            <div class="divider-icon">
                <div class="divider-icon-wrapper">
                    <img src="{{ url ~ '/images/icons/divider-topic-icon.png' }}" alt="">
                </div>
            </div>
            <div class="support-description">
                <h2>{{ homeArray[15] }}</h2>
                <p>{{ homeArray[35] }}</p>
                <div class="people">
                    {%- for title, social in config.path('social', []) -%}
                        <div class="people__list">
                            <a href="{{ social.link }}" title="{{ title }}" target="_blank">
                                <img src="{{ url ~ social.icon }}" alt="{{ title }}">
                            </a>
                        </div>
                    {%- endfor -%}
                </div>
            </div>

            {%- include 'inc/contact-us.volt' -%}
        </div>
    </div>
</section>
