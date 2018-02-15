# The Jumpoff

## Just a simple WP and Gulp starter to set it off.

Contains a bit of useful css, senseable scss/js structuring, a js includes system (see src/assets/js/app.js), Handlebars-enabled partials, and error notices.

### Run

Just run `gulp` from the project. Note, moved gulp tasks to only css, js, image, svg stuff. The standard Src, Build, Symlinks, thing became a pain with Wp. This feels slightly less painful.... for now anyway.

### Composer

Loading StoutLogic ACF Builder for registering fields.

Just `composer install`

### Fields & Modules

As mentioned above, we're using ACF for fields, but instead of the GUI, were using StoutLogic ACF Builder to define fields via php Helpers
Additionally, a custom drag-and-drop module system is in place that goes off namings of Flexible content fields.

See `inc/utils/class-acf-modules.php` for the class, and `partials/modules` for the actual module views

Calling the Modules in a template

```
while (has_sub_field('modules')) :
  ACF_Modules::render(get_row_layout());
endwhile;
```

### INC

Site functionality is generally added in the `inc` folder, as oppose to plugins and whatnot.

### CSS / JS

As much as possible, css and js is organized by component, named after it's useage / BEM naming convention. JS files are loaded via `gulp includes` from `js/_app.js`. Most stuff in this project is just ES5. Will probably change that soon.
