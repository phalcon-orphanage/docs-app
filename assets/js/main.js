"use strict"

/**
 * инициализация всех инициализаций
 */
$(document).ready(function()
{
	o2.init();
});

/**
 * основной объект
 * @type {object}
 */
var o2 =
{
	/**
	 * вызов функций, которые должны запускаться при загрузке страницы
	 */
	init: function()
	{
		this.header.mobileNavDropdown();
		this.header.closeMobileNav('.header-nav__burger');
		hljs.initHighlightingOnLoad();
		this.projects.init();
		this.documentation.init();
	},
	header:
	{
		openMobileNav: function(instance)
		{
			if ($(instance).hasClass('active') == false)
			{
				$(instance).addClass('active');
				$(instance).parents().find('._navToggle').addClass('active');
				$('body').addClass('hidden');
				event.stopPropagation();
			}
		},

		closeMobileNav: function(instance)
		{
			$(document).click(function() {
				if ($(instance).hasClass('active'))
				{
					$(instance).removeClass('active');
					$(instance).parents().find('._navToggle').removeClass('active');
					$('body').removeClass('hidden');
				}
			});
		},

		mobileNavDropdown: function()
		{
			var extAcc = $('.extendable');

			for (i = 0; i < extAcc.length; i++) {
				extAcc[i].addEventListener("click", function() {
					this.classList.toggle("extended");
				});
			}
		}
	},
	projects:
	{
		init: function()
		{
			if($('.add-project').length == 0)
				return false;

			this.addPreview();
			this.addScreenshots();
		},
		addPreview: function()
		{
			var imagePreview = function(input, placeToInsertImagePreview)
			{

				if (input.files)
				{
					var filesAmount = input.files.length;

						var reader = new FileReader();

						reader.onload = function(event)
						{
							$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).wrap('<div class="upload-item"></div>');
						}

						reader.readAsDataURL(input.files[0]);
				}

			};

			$('#upload-preview').on('change', function()
			{
				imagePreview(this, 'div._uploadPreview');
			});
		},

		addScreenshots: function()
		{
			var sreenshotsPreview = function(input, placeToInsertImagePreview)
			{

				if (input.files)
				{
					var filesAmount = input.files.length;

					for (i = 0; i < filesAmount; i++)
					{
						var reader = new FileReader();

						reader.onload = function(event)
						{
							$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).wrap('<div class="upload-item"></div>');
						}

						reader.readAsDataURL(input.files[i]);
					}
				}

			};

			$('#upload-screenshots').on('change', function()
			{
				sreenshotsPreview(this, 'div._uploadScreens');
			});
		}
	},

	documentation:
	{
		init: function()
		{
			if($('.phalcon-blog_documentation').length == 0)
				return false;

			this.articleNav.init();
		},
		// show/close sublist on right navigation
		toggleSublist: function(instance)
		{
			$(instance).toggleClass('documentation-nav-item__label_opened');
			$(instance).siblings('.documentation-nav-item__sublist').slideToggle(300);
		},
		// left navigation on article
		articleNav:
		{
			inViewport: function(item) {
				var elementTop = $(item).offset().top;
				var elementBottom = elementTop + $(item).outerHeight();

				var viewportTop = $(window).scrollTop();
				var viewportBottom = viewportTop + $(window).height();

				return elementBottom > viewportTop && elementTop < viewportBottom;
			},
			// header on article
			headers: [],
			// left navigation items templates
			itemTemplates:
			{
				h1:
				{
					marker: '<div class="doc-article-nav-markers__item doc-article-nav-markers__item_main" data-id="#id#"></div>',
					link: '<a href="#anchor#" class="doc-article-nav-list-link" data-id="#id#"#>#text#</a>',
				},
				h2:
				{
					marker: '<div class="doc-article-nav-markers__item" data-id="#id#"></div>',
					link: '<a href="#anchor#" class="doc-article-nav-list-link" data-id="#id#">#text#</a>',
				},
				h3:
				{
					marker: '<div class="doc-article-nav-markers__item doc-article-nav-markers__item_sub-item" data-id="#id#"></div>',
					link: '<a href="#anchor#" class="doc-article-nav-list-link doc-article-nav-list-link_sub-item" data-id="#id#">#text#</a>',
				},
				h4:
				{
					marker: '<div class="doc-article-nav-markers__item doc-article-nav-markers__item_sub-item" data-id="#id#"></div>',
					link: '<a href="#anchor#" class="doc-article-nav-list-link doc-article-nav-list-link_sub-item" data-id="#id#">#text#</a>',
				}
			},
			lastScrollTop: 0,
			activeElement: null,
			activeElementIndex: 0,
			windowWidth: 0,
			// init methods for create left navigation
			init: function()
			{
				this.windowWidth = $(document).width();
				this.parseHeaders();
				this.generateMenu();

				$('.doc-article-nav-markers__item').first().addClass('active');
				$('.doc-article-nav-list-link').first().addClass('active');

				this.activeElement = this.headers[0].element;

				$(document).scroll(this.changeActiveItem.bind(this));
				$(window).on('resize', (function()
				{
					this.windowWidth = $(document).width();
					this.changeActiveItem();
				}).bind(this));
			},
			// change active items on left navigation
			changeActiveItem: function()
			{
				if(this.windowWidth < 1024)
					return false;

				var itScrollToTop = (this.lastScrollTop > $(document).scrollTop()) ? true : false;

				for(var i = 0; i < this.headers.length; i++)
				{
					if(this.inViewport($(this.headers[i].element)) && this.activeElement != this.headers[i].element)
					{
						if ((itScrollToTop && this.activeElementIndex + 1 == i) || (!itScrollToTop && this.activeElementIndex - 1 == i))
							break;

						this.activeElement = this.headers[i].element;
						this.activeElementIndex = i;
						break;
					}
				}

				// if its scroll to top - set active on top items
				if (itScrollToTop && (!this.inViewport($(this.activeElement))
					&& ($(this.activeElement).offset().top > $(document).scrollTop()
					|| $(document).scrollTop() < 300)))
					this.activeElementIndex = (this.activeElementIndex - 1) <= 0 ? 0 : this.activeElementIndex - 1;

				if(!$('.doc-article-nav-list-link[data-id="'+ this.headers[this.activeElementIndex].id + '"]').hasClass('active'))
				{
					$('.doc-article-nav-markers__item, .doc-article-nav-list-link').removeClass('active');
					$('[data-id="'+ this.headers[this.activeElementIndex].id + '"]').addClass('active');
					this.activeElement = this.headers[this.activeElementIndex].element;
				}

				this.updateArticleNav();

				this.lastScrollTop = $(document).scrollTop();

			},
			// update article nav in page top
			updateArticleNav: function()
			{
				var articleNavOffset = $('.doc-article-nav-items')[0].getBoundingClientRect().top
				if(articleNavOffset > 20)
				{
					$('.doc-article-nav-items').addClass('doc-article-nav-items_top');
					$('.doc-article-nav-items').css({'max-height': 'calc(100vh - ' + (articleNavOffset + 20) + 'px)'});
					this.changeMarkersMargin();
				}
				else if(articleNavOffset <= 20 && $('.doc-article-nav-items').hasClass('doc-article-nav-items_top'))
				{
					$('.doc-article-nav-items').css({'max-height': 'calc(100vh - 40px)'});
					$('.doc-article-nav-items').removeClass('doc-article-nav-items_top');
					this.changeMarkersMargin();
				}
			},
			// get headers from article
			parseHeaders: function()
			{
				var headers = $('.phalcon-blog_documentation').find('h1, h2, h3, h4');
				$(headers).each(function(index, element)
				{
					var id = $(element).attr('id');

					if(typeof id == 'undefined')
					{
						id = 'header-' + index;
						$(element).attr('id', id);
					}

					o2.documentation.articleNav.headers.push({
						element: element,
						tagName: $(element).prop('tagName').toLowerCase(),
						text: $(element).text(),
						id: id
					});
				});
			},
			changeMarkersMargin: function()
			{
				if($(window).height() < 1200 && this.headers.length > 15)
				{
					$('.doc-article-nav-markers__item').css({'margin-bottom': $('.doc-article-nav-items').height() / this.headers.length - 2} )
				}
			},
			// add items to left navigation
			generateMenu: function()
			{
				for(var i = 0; i < this.headers.length; i++)
				{
					var item = this.headers[i];
					var markerTmp = this.itemTemplates[item.tagName].marker.replace(/#id#/g, item.id);
					var linkTmp = this.itemTemplates[item.tagName].link
						.replace(/#anchor#/g, '#' + item.id)
						.replace(/#text#/g, item.text)
						.replace(/#id#/g, item.id);

					$('.doc-article-nav-markers').append(markerTmp);
					$('.doc-article-nav-list').append(linkTmp);
				}
				this.changeMarkersMargin();
			}
		}
	}
}