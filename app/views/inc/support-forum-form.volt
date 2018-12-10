<div class="support-forum__contact">
    <div class="support-picture-wrapper">
        {{ filesystem.read('/public/images/icons/topic-message-icon.svg') }}
    </div>
    <p class="support-forum__header">
        {{ home['looking_for_help'] }}
    </p>
    <p class="support-forum__description">
        {{ home['join_forum'] }}
    </p>
    <a href="https://phalcon.link/forum" class="support-forum__button" target="_blank">
        {{ home['support_forums'] }}
    </a>
</div>
