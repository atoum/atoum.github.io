# atoum's website source code

This repo contains the source code for atoum website, [atoum.org](http://atoum.org).

## Build & preview locally

* Clone this repository
* Use one of the following method
* Then use your favorite browser to [preview it](http://127.0.0.1:4000)

### Using bundle

Install dependencies (assuming you have a working [bundler](http://bundler.io/) installation).

```bash
bundle install
bundle exec jekyll serve --watch
```

### Using docker

```bash
docker run -i -t -v $PWD:/srv/jekyll -p 4000:4000 jekyll/jekyll:pages jekyll serve --watch
```

### Using docker-compose

```bash
docker-compose up
```
