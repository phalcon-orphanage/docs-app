<section class="topics-section">
    <div class="container">
        <div class="row support-forums">
            <div class="col-md-8">
                <div class="topic">
                    <div class="topic-picture-wrapper">
                        {{ filesystem.read('/public/images/icons/topic-head-icon.svg') }}
                    </div>
                    <h2>Explore Topics</h2>
                    <p>We did our best to cover all topics related to this product. Each section have number which represent number of topic in each category.</p>
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
                    Explore All Topics
                </a>
            </div>

        </div>
    </div>
</section>
