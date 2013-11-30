#
# Config your Heroku app & theme
#
APP_NAME      = "wordpress-heroku-sprockets"
THEME_FOLDER  = "example-theme"


#
# No need to update below
#
require 'rubygems'
require 'bundler'
require 'pathname'
require 'logger'
require 'fileutils'
require 'compass'
require "uglifier"

Bundler.require

ROOT          = Pathname(File.dirname(__FILE__))
COMPASS_DIR   = Pathname(Gem.loaded_specs['compass'].full_gem_path)
BUILD_DIR     = ROOT.join("wp-content/themes/#{THEME_FOLDER}/public")
SOURCE_DIR    = ROOT.join("wp-content/themes/#{THEME_FOLDER}/assets")


desc "Compile javascript & SCSS in #{THEME_FOLDER}"
task :compile do
  sh "bower install"

  sprockets = Sprockets::Environment.new(ROOT) do |env|
    env.logger = Logger.new(STDOUT)
  end

  sprockets.js_compressor = Uglifier.new

  sprockets.append_path(COMPASS_DIR.join('frameworks', 'compass', 'stylesheets'))
  sprockets.append_path(SOURCE_DIR.join('javascripts'))
  sprockets.append_path(SOURCE_DIR.join('stylesheets'))
  sprockets.append_path(SOURCE_DIR.join('vendor', 'components'))

  js_asset = sprockets.find_asset('application.js')
  js_asset.write_to(BUILD_DIR.join('application.js'))

  css_asset = sprockets.find_asset('application.css')
  css_asset.write_to(BUILD_DIR.join('application.css'))
end


namespace :deploy do

  desc "Deploy the app to staging environment"
  task :staging do
    app     = "#{APP_NAME}-s"
    remote  = "git@heroku.com:#{APP_NAME}-s.git"

    sh "heroku maintenance:on --app #{app}"
    sh "heroku config:set BUILDPACK_URL=https://github.com/yvesvanbroekhoven/heroku-buildpack-wordpress --app #{app}"
    sh "git push #{remote} master"
    sh "heroku maintenance:off --app #{app}"
  end

  desc "Deploy the app to production environment"
  task :production do
    app     = "#{APP_NAME}-p"
    remote  = "git@heroku.com:#{APP_NAME}-p.git"

    sh "heroku maintenance:on --app #{app}"
    sh "heroku config:set BUILDPACK_URL=https://github.com/yvesvanbroekhoven/heroku-buildpack-wordpress --app #{app}"
    sh "git push #{remote} master"
    sh "heroku maintenance:off --app #{app}"
  end

end
