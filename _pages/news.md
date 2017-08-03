---
layout: static
title: News
---

<h1>News</h1>

{% for post in site.posts %}
<section class="post-list">
## [{{ post.title }}]({{ post.url | prepend: site.baseurl }}) <small>{{ post.date | date_to_long_string }}</small>
</section>
{% endfor %}
