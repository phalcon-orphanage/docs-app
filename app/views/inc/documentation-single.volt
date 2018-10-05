<section class="documentation-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-lg-9 parse-content">
                <div>
                    {% if language == 'en' %}
                        <a class="article-content-edit-link pull-right"
                           href="https://github.com/phalcon/docs/blob/{{ version }}/en/{{ page == null ? '': page ~".md" }}">
                            {{ homeArray[40] }}
                        </a>
                    {% else %}
                        <a class="article-content-edit-link pull-right"
                           href="https://crowdin.com/project/phalcon-documentation/{{ language }}">
                            {{ homeArray[41] }}
                        </a>
                    {% endif %}
                    <br>
                </div>
                {{ article }}
            </div>
            <div class="col-md-4 col-lg-3 col-sm-12 support-column-margin">
                {% include 'inc/topics-sidebar.volt' %}
                {% include 'inc/article-menu.volt' %}
                {# TODO(o2) {% include 'inc/support-forum-form.volt' %} #}
            </div>
        </div>
    </div>
</section>
