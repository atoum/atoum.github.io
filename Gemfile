source 'https://rubygems.org'

require 'json'
require 'open-uri'
versions = JSON.parse(open('https://pages.github.com/versions.json').read)

versions.each do |name, version|
    gem name, version unless ['github-pages', 'jekyll', 'ruby'].include? name
end

gem 'jekyll', '~> 2.5.3'

group :jekyll_plugins do
  gem 'algoliasearch-jekyll', '~> 0.4.3'
end
