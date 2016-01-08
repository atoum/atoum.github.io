---
layout: static
---

<h1>News</h1>

{% for post in site.posts %}
<section class="visual-section">
## [{{ post.title }}]({{ post.url | prepend: site.baseurl }}) <small>{{ post.date | date_to_long_string }}</small>
</section>
{% endfor %}
