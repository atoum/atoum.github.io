---
layout: static
---

<h1>News</h1>

{% for post in site.posts %}
<section class="visual-section">
## <a class="jekmdl-post-list" href="{{ post.url | prepend: site.baseurl }}">{{ post.title }}</a> <small>{{ post.date | date_to_long_string }}</small>
</section>
{% endfor %}
