<section class="topics-section">
    <div class="container">
        <div class="row support-forums">
            <div class="col-md-8">
                <div class="topic">
                    <div class="topic-picture-wrapper">
                        {{ filesystem.read('/public/images/icons/topic-head-icon.svg') }}
                    </div>
                    <h2>{{ home['explore_topics'] }}</h2>
                    <p>
                        {{ home['we_did_our_Best'] }}
                    </p>
                    <hr>
                </div>
            </div>
            {% include 'inc/support-forum-form.volt' %}
        </div>
        <div class="row">
            {% for key, topic in topicsArray %}
            {% if (key + 1) % 3 == 0 %}
        </div>
        {% if key > 4 %}
        <div class="row topic__list-padding hidden-topic" style="display:none;">
            {% else %}
            <div class="row topic__list-padding">
                {% endif %}
                {% endif %}

                <div class="col-md-4 col-sm-6 col-xs-12 column-style">
                    {% include 'inc/topic-item.volt' %}
                </div>
                {% endfor %}
            </div>
            <div class="explore-topic">
                <a href="javascript:void(0);" class="explore-topic__link" onclick="o2.toggleAllTopic(this)">
                    {{ home['explore_all_topics'] }}
                </a>
            </div>

        </div>
    </div>
</section>
