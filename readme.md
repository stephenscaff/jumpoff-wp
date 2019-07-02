# The Jumpoff

## Just a simple WP and Gulp starter to set it off.

The Jumpoff is a fairly opinionated starter for custom Wordpress development. It's a platform for beginning web projects that moves away from the interchangable theme / child theme approach.

Additionally, the Jumpoff aims to reduce over-reliance on 3rd party plugins by baking project features and settings into the starter (via an `inc` directory).

### Features

- Gulp for task running
- Organization by partials and components of scss, js and php views.
- Custom drag and drop modules for content authorship
- A php approach to field management via ACF and Stout Logic's ACF Builder
- Custom Admin theme (styles and functionality)
- A library of useful utilities/helpers

### Dependencies
- [Node](https://nodejs.org/en/download/) : to run `gulp`.
- [NPM](https://www.npmjs.com/get-npm) : also to run `gulp`.
- [Gulp](https://gulpjs.com/) : for compiling, minimizing and linting scss, js, svgs, images, etc.
- [SCSS/SASS](https://sass-lang.com/) : for css authorship.
- [WordPress](https://wordpress.org/) : This is a custom Wordpress build
- [ACF](https://www.advancedcustomfields.com/pro/) : For managing fields, metas, options, etc.
- [StoutLogic ACF Builder](https://github.com/StoutLogic/acf-builder) : A more sane way to register ACF fields within PHP utils

### Run

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

The Modules are then included and added to a modules template (or whatever) at `inc/Fields/Modules.php`.

A custom module loader class (`inc/Acf/AcfModules.php`) further enhances flexible content fields by mapping them by name to files within the `views/modules` directory. So, when used, a module field named `posts-module` will load and scope it's fields to a module file at `views/modules/posts-module.php`.

For Example:

**Define Content Module**  


```
// inc/Fields/Modules/Content

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Content Module
 * Creates an content / wysi section
 * @see scss/components/_content (post-content)
 */
$content_module = new FieldsBuilder('content_module');
$content_module
  ->addMessage('', 'The Content Module creates an all purpose content/wysi region.')
  ->addWysiwyg('content');

```

**Apply Content Module to Modules Template**  


```
// inc/Fields/modules.php

use StoutLogic\AcfBuilder\FieldsBuilder;


require_once('Modules/Content.php');
...



$modules= new FieldsBuilder('modules');

$modules
  ->addFlexibleContent('modules',
    ['button_label'=> 'Add Module']
  )
  ->addLayout($cards_module,
    ['name'=> 'cards_module']
  )
  ...
  ->setLocation('page_template', '==', 'templates/modules.php')
    ->or('page_template', '==', 'templates/home.php');

  add_action('acf/init', function() use ($modules) {
     acf_add_local_field_group($modules->build());
  });
```

**Content Module View**

```
// views/modules/content-module.php

namespace Jumpoff;

$content = get_sub_field('content');

?>

<section class="content module">
  <div class="grid-sm">
    <?php echo $content; ?>
  </div>
</section>

```

**Calling the Modules in a template**  


```
// views/shared/modules.php

while (has_sub_field('modules')) :
  ACF_Modules::render(get_row_layout());
endwhile;
```


### Inc

Site functionality is generally added in the `inc` folder, as oppose to plugins and whatnot.


### Admin theme

A custom admin theme and various admin-based functionality and utilities are housed in `inc/Admin`. `AdminTheme` includes the scss for our, eh, admin theme. `admin.scss` compiles out via gulp into `admin.css`.

### Post/Content Types

Custom Post Types are registered in `inc/PostTypes` and follow a simple file naming convention.

### Utils

Post helpers, found in `inc/Utils` include utility functions for stuff like hooks, actions, formatters, helpers, etc.
