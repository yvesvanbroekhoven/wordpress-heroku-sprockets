# Wordpress ready for Heroku & support for Sprockets

## Say what?

I love Ruby on Rails, but I also love Wordpress. One of the great features of
Ruby on Rails is the Asset Pipeline based on Sprockets. To keep my workflow
the same over projects, I set up a Wordpress skeleton ready to use with Sprockets.

This means support instant support for:

* SASS
* Compass
* Bower
* Minifyied CSS & Javascript


## Get started

I've added an example theme named 'example-theme' with the necessary folder
structure.

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


## TODO

* Heroku deploy script
