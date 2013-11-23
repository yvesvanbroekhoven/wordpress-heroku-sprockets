THEME_NAME = "example-theme"

guard 'rake', :task => 'compile' do
  watch(%r{^wp-content/themes/example-theme/assets/javascripts/.*.js})
  watch(%r{^wp-content/themes/example-theme/assets/javascripts/(initializers|modules)/.*.js})

  watch(%r{^wp-content/themes/example-theme/assets/stylesheets/.*.scss})
  watch(%r{^wp-content/themes/example-theme/assets/stylesheets/(base|modules)/.*.scss})
end
