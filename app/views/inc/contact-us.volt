<div class="contact-us-container clearfix">
    <div class="contact-us__image-wrapper">
        {{ filesystem.read('/public/images/icons/message-icon.svg') }}
    </div>
    <div class="contact-us__description">
        <h2>{{ home['contact_us'] }}</h2>
        <p>{{ home['questions_contact_us'] }}</p>
    </div>
    <a href="mailto:team@phalconphp.com">{{ home['write_to_us_now'] }}</a>
</div>
