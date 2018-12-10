<div class="topic-categories">
    {% for topic in topicsArray %}
        <div class="topic-categories-item {% if loop.index > 4 %}topic-categories__all-topic{% endif %}"
             {% if loop.index > 4 %}style="display:none;"{% endif %}>
            <div class="category-name" onclick="o2.topicsAccordion(this, event)">
                <span>{{ topic["name"] }}</span>
            </div>
            <ul style="display: none;">
                {% for topicItem in topic["subItems"] %}
                    <li>
                        <a href="{{ topicItem["subLink"] }}">
                            <span>{{ topicItem["subName"] }}</span>
                        </a>
                    </li>
                {% endfor %}
            </ul>
        </div>
    {% endfor %}
    <a href="javascript:void(0);" class="topic-categories__explore-all-topic" onclick="o2.toggleAllTopicSidebar(this)">
        {{ home['explore_all_topics'] }}
    </a>
</div>
