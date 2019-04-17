# The Jumpoff

## Just a simple WP and Gulp starter to set it off.

The Jumpoff is a fairly opinionated starter for custom Wordpress development. It's a platform for beginning web projects that moves away from the interchangable theme / child theme approach.

Additionally, the Jumpoff aims to reduce over-reliance on 3rd party plugins by baking project features and settings into the starter (via an `inc` directory).

### Features

- Gulp for task running
- A lightweight front-end framework of sorts, with sensible scss/js structuring.
- Organization by partials and components
- A php approach to field management via ACF and Stout Logic's ACF Builder
- Custom drag and drop modules for content authorship
- Custom Admin theme (styles and functionality)
- A small library of useful utilities/helpers

### Dependencies
- [Node](https://nodejs.org/en/download/) : to run `gulp`.
- [NPM](https://www.npmjs.com/get-npm) : also to run `gulp`.
- [Gulp](https://gulpjs.com/) : for compiling, minimizing and linting scss, js, svgs, images, etc.
- [SCSS/SASS](https://sass-lang.com/) : for css authorship.
- [WordPress](https://wordpress.org/) : This is a custom Wordpress build
- [ACF](https://www.advancedcustomfields.com/pro/) : For managing fields, metas, options, etc.
- [StoutLogic ACF Builder](https://github.com/StoutLogic/acf-builder) : A more sane way to register ACF fields within PHP utils

### Run

Install Gulp

```
npm install gulp
```

Install Gulp dependencies

```
npm install --save-dev
```

Install Composer dependencies

```
composer install
```


### Composer

Currently Composer is just installing StoutLogic's ACF Builder.

Make sure to run composer first, or the theme can't locate autoload and you'll see a custom error.


### CSS / JS

As much as possible, css and js is organized by component, named after it's usage / BEM naming convention. JS files are loaded through `app.js` as module imports leveraging browserfy and babel.

### Setup
`inc/Setup/Setup` houses a setup singleton class to kick things off.

### Better Folder Org
`inc/Setup/loader.php` contains a template loader filter to reorg how wp loads template files.
Now, are components and single/archive/search files are housed in `views` and organized by content type.

For example, `single.php` is now found in `views/post/single.php` and an archive for the post type `Work` would be found in `views/work/archive.php`, etc. Partials are genreally scopped to their content type folder as well, using the underscore naming convention to indicate their included nature - ie, `inc/work/_nav.php`.

Share files like app wide headers and footer are housed in `views/shared/*`, ie `views/shared/header.php`.

Default files like `archive.php` are left in place currently and simple include to their enhanced locations.... for now... just in case. I'll pull them shortly.

### Fields

The Jumpoff uses ACF for Fields, but actual field authorship is enhanced with [Stout Logic's ACF Builder](https://github.com/StoutLogic/acf-builder).


After running into various environmental issues with `acf-json`, I opted for a more robust and transferable solution that supports variables for reuse and version control.

Stout Logic provides a fluent API for rapidly creating and configuring ACF Fields in PHP, using a really nice builder pattern.

Here's an example of creating fields for SEO metas:

```

/**
 * Fields - SEO
 * Location: Pages, posts, Team post type.
 */
$seo_fields = new StoutLogic\AcfBuilder\FieldsBuilder('seo', [
  'key' => 'seo',
  'position' => 'normal',
]);

$seo_fields
  ->addText('seo_title')
  ->addTextArea('seo_description',  [
    'rows' =>  '2'
  ])
  ->addImage('seo_image')
  ->setLocation('post_type', '==', 'page')
    ->or('post_type', '==', 'post')
    ->or('post_type', '==', 'team');

add_action('acf/init', function() use ($seo_fields) {
   acf_add_local_field_group($seo_fields->build());
});
```

All Fields are registered in `inc/Fields/*`, generally in their own clearly named file. Variables for reuse are housed in `inc/Fields/vars.php`


# Modules

The Jumpoff uses ACF's Flexible content fields to create a drag-and-drop module system and are defined at `inc/Fields/Modules/*`

A custom module loader class (`inc/Acf/AcfModules.php`) further enhances flexible content fields by mapping them by name to files within the `partials/modules` directory. So, when used, an FC field named `intro-module` with load the module file `intro-module.php`.

Calling the Modules in a template

```
while (has_sub_field('modules')) :
  ACF_Modules::render(get_row_layout());
endwhile;
```

https://gist.github.com/tdwesten/3402b2c5ef0843df6bb65afbb4835f99


### Inc

Site functionality is generally added in the `inc` folder, as oppose to plugins and whatnot.


### Admin theme

A custom admin theme and various admin-based functionality and utilities are housed in `inc/Admin`. `AdminTheme` includes the scss for our, eh, admin theme. `admin.scss` compiles out via gulp into `admin.css`.

### Content Types

Custom Post Types are registered in `inc/PostTypes` and follow a simple file naming convention.

### Utils

Post helpers, found in `inc/Utils` include utility functions for stuff like hooks, actions, formaters, helpers, etc.
