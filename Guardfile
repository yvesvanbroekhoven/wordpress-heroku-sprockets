THEME_NAME = "example-theme"

guard 'rake', :task => 'compile' do
  watch(%r{^wp-content/themes/#{THEME_NAME}/assets/javascripts/.*.js})
  watch(%r{^wp-content/themes/#{THEME_NAME}/assets/javascripts/(initializers|modules)/.*.js})

  watch(%r{^wp-content/themes/#{THEME_NAME}/assets/stylesheets/.*.scss})
  watch(%r{^wp-content/themes/#{THEME_NAME}/assets/stylesheets/(base|modules)/.*.scss})
end
