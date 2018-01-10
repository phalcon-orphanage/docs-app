<section class="documentation-section">
	<div class="container">
		<div class="row">
			<div class="col-md-8 parse-content">
				<div>
				    {% if language == 'en' %}
				    <a class="article-content-edit-link pull-right" href="https://github.com/phalcon/docs/blob/{{ version }}/en/{{ page == null ? '': page ~".md"}}">Edit on GitHub</a>
				    {% else %}
				    <a class="article-content-edit-link pull-right" href="https://crowdin.com/project/phalcon-documentation/{{language}}">Edit on Crowdin</a>
				    {% endif %}
				    <br>
				</div>
				{{ article }}
			</div>
			<div class="col-md-4 col-sm-12 support-collumn-margin">
				{% include 'inc/topics-sidebar.volt' %}
				{% include 'inc/article-menu.volt' %}
				{#{% include 'inc/support-forum-form.volt' %}#}
			</div>
		</div>
	</div>
</section>