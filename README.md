# Wordpress ready for Heroku & support for Sprockets

## Say what?

I love Ruby on Rails, but I also love Wordpress. One of the great features of
Ruby on Rails is the Asset Pipeline based on Sprockets. To keep my workflow
the same over projects, I set up a Wordpress skeleton ready to use with Sprockets.

This means support instant support for:

* SASS
* Compass
* Bower
* CommonJS
* Minifyied CSS & Javascript


## Get started

I've added an example theme named 'example-theme' with the necessary folder
structure.

### Configuration

Update Rakefile with your theme folder name.


### Commands

Install dependencies:

```
$ bundle
```

Start watching javascript & SCSS files:

```
$ bundle exec guard
```

Or you can compile manually:

```
$ bundle exec rake compile
```


## Deploy to Heroku

### Configuration

Update Rakefile with your Heroku app name. We like to work with 2 environments:

* staging
* production

As naming convention we use app-name-s for staging and app-name-p for production.

### Forklift

[https://github.com/fd/forklift](https://github.com/fd/forklift)

```
forklift deploy -t staging
```

### Rake

```
bundle exec rake deploy:staging
```
