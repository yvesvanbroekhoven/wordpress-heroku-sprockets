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
$ forklift deploy -t staging
```

### Rake

```
$ bundle exec rake deploy:staging
```


## Production environment

### Cloudflare settings

**Page rules**

* http://url.com/*
  forwarding to http://www.url.com/$1
* \*url.com/wp-*
  Always online: Off, Rocket Loader: Off, Cache level: Bypass cache
* \*url.com/*
  Always online: On, Cache expiration: 30 minutes, Cache level: Cache everything


### Add cache headers

Add this at line 1 in your header.php of your theme:

```
<?php
  /*
   * Write headers
   */
  $offset = 60 * 15; // 15 minutes
  header("Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT");
  header("Cache-Control: public, max-age=$offset, must-revalidate");
  header("Pragma: public");
?>
```

### Hide the admin bar on the frontend

Be sure to do this when you're using Cloudflare. Otherwise your cache can end up with the admin bar inside.

Add in your functions.php:

```
/**
 * Hide admin bar on frontend
 * More info: http://davidwalsh.name/hide-admin-bar-wordpress
 */
add_filter('show_admin_bar', '__return_false');
```
