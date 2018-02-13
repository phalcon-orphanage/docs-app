<section class="support-section">
	<div class="container">
		<div class="support-wrapper">
            <div class="divider-icon">
                <div class="divider-icon-wrapper">
                    <img src="{{ url ~ '/images/icons/divider-topic-icon.png' }}" alt="">
                </div>
            </div>
            <div class="support-description">
                <h2>Get Support From Real People</h2>
                <p>When you are stuck in something don’t waste your time just let us know we are here to help you</p>
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
