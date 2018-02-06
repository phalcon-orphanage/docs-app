<div class="topic-item">
    <div class="list-head">
        <div class="list-head__circle-number">
        {{ key + 1 }}
        </div>
        <p>{{ topic["name"] }}</p>
    </div>
    <ul>
        {% for topicItem in topic["subItems"] %}
            <li>
                <a href="{{ topicItem["subLink"] }}">
                    <div class="topic-item-icon-wrapper">
                        <img src="/images/icons/topic-item-icon.svg" alt="">
                    </div>
                    <p><span>{{ topicItem["subName"] }}</span></p>
                </a>
            </li>
        {% endfor %}
    </ul>
</div>
