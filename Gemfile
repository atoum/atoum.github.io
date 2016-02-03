source 'https://rubygems.org'

require 'json'
require 'open-uri'
versions = JSON.parse(open('https://pages.github.com/versions.json').read)

gem 'github-pages', versions['github-pages']
gem 'pygments.rb'

group :jekyll_plugins do
  gem 'algoliasearch-jekyll', '~> 0.4.3'
end
