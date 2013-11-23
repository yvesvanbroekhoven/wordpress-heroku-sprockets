guard 'sprockets',
  :destination => 'wp-content/themes/example-theme/public',
  :asset_paths => [
    'wp-content/themes/example-theme/assets/javascripts',
    'wp-content/themes/example-theme/assets/stylesheets'
  ],
  :minify => true do
    watch (%r{wp-content/themes/example-theme/assets/javascripts/(modules|initializers)/.*.js.*}){ |m|
      "wp-content/themes/example-theme/assets/application.js"
    }
    watch (%r{wp-content/themes/example-theme/assets/stylesheets/(base|modules)/.*.css.*}){ |m|
      "wp-content/themes/example-theme/assets/application.css.scss"
    }
    #watch ("wp-content/themes/example-theme/assets/javascripts/application.js")
end
