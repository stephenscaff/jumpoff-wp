# The Jumpoff

## Just a simple WP and Gulp starter to set it off.

Contains a bit of useful css, senseable scss/js structuring, a js includes system (see src/assets/js/app.js), Handlebars-enabled partials, and error notices.

### Run

Just run `gulp install --save-dev` from the project directory. Note, moved gulp tasks to only css, js, image, svg stuff. The standard Src, Build, Symlinks, thing became a pain with Wp. This feels slightly less painful.... for now anyway. See `gulpfile.js` for the various tasks and includes.

### Composer

Loading StoutLogic ACF Builder for registering fields.

Just `composer install`

Make sure to run composer first, or the theme can't locate autoload and you'll see a custom error.


### CSS / JS

As much as possible, css and js is organized by component, named after it's usage / BEM naming convention. JS files are loaded via `gulp includes` from `js/_app.js`. Most stuff in this project is just ES5 right now. Will probably change that soon.


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

I used to rock `acf-json` but after running into some issues with moving from local to prod and duplicates and file permissions and so on, I opted for a more robust solution. StoutLogic's ACF Builder is nice as it allows you to create fields in php, with sanity, enabling to create a lib of fields that can be reused via variables.

Still figuring out the best way to work with it, but for now I register global fields and 'modules' and apply then as needed. All fields are added from `inc/fields` and global fields are found with `fields-global.php` and `fields-global-modules.php`.


### INC

Site functionality is generally added in the `inc` folder, as oppose to plugins and whatnot.


### Admin theme

A custom admin theme and various admin-based functionality and utilities are housed in `inc/admin`. `admin-theme` includes the scss for our, eh, admin theme. `admin.scss` compiles out via gulp into `admin.css`.

### Content Types

Custom Post Types are registered in `inc/post-types` and follow a simple file naming convention.

### Settings

Various wp and theme setting are housed in `inc/settings`. This includes stuff like the management of images settings, defining theme support, permalinks structure, some clean, a max image upload size utility, etc.

### Post Helpers

Post helpers, found in `inc/post-helpers` include helper functions and classes for things relating to, or called within posts and content files/templates/partials - ie; A featured image helper, a post excerpt helper, various taxonomy/categorey helpers, etc.

### Utils

Utility functions include path helpers, body class helpers, our ACF Module class, handy conditionals, some formatting stuff, etc.
