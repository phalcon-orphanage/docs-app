<div class="topic-categories" >
	{% for topic in topicsArray %}
		{% if loop.index > 4 %}
			<div class="topic-categories-item topic-categories__all-topic" style="display:none;">
		{% else %}
			<div class="topic-categories-item" >
		{% endif %}
		
			<div class="categoty-name" onclick="o2.topicsAccordeon(this, event)"><span>{{ topic["name"] }}</span></div>
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
		Explore All Topics
	</a>
</div>