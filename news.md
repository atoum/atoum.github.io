---
layout: static
title: News
---

<h1>News</h1>

{% for post in site.posts %}
<section class="visual-section">
{% if post.link %}
## [{{ post.title }}]({{ post.link }}) <small>{{ post.date | date_to_long_string }}</small>
{% else %}
## [{{ post.title }}]({{ post.url | prepend: site.baseurl }}) <small>{{ post.date | date_to_long_string }}</small>
{% endif %}
</section>
{% endfor %}
