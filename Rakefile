require 'rubygems'
require 'bundler'
require 'pathname'
require 'logger'
require 'fileutils'
require 'compass'
require "uglifier"

Bundler.require

THEME_NAME    = "example-theme"

ROOT          = Pathname(File.dirname(__FILE__))
COMPASS_DIR   = Pathname(Gem.loaded_specs['compass'].full_gem_path)
BUILD_DIR     = ROOT.join("wp-content/themes/#{THEME_NAME}/public")
SOURCE_DIR    = ROOT.join("wp-content/themes/#{THEME_NAME}/assets")

task :compile do
  sprockets = Sprockets::Environment.new(ROOT) do |env|
    env.logger = Logger.new(STDOUT)
  end

  sprockets.js_compressor = Uglifier.new

  sprockets.append_path(SOURCE_DIR.join('javascripts'))
  sprockets.append_path(SOURCE_DIR.join('stylesheets'))
  sprockets.append_path(COMPASS_DIR.join('frameworks', 'compass', 'stylesheets'))

  js_asset = sprockets.find_asset('application.js')
  js_asset.write_to(BUILD_DIR.join('application.js'))

  css_asset = sprockets.find_asset('application.css')
  css_asset.write_to(BUILD_DIR.join('application.css'))
end
