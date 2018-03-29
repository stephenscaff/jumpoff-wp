/**
 * Gulp Modules
 */
const
  gulp          = require('gulp'),
  plumber       = require('gulp-plumber'),
  newer         = require('gulp-newer'),
  imagemin      = require('gulp-imagemin'),
  svgo          = require('gulp-svgo'),
  uglify        = require('gulp-uglifyes'),
  jshint        = require('gulp-jshint'),
  sass          = require('gulp-sass'),
  autoprefixer  = require('gulp-autoprefixer'),
  rename        = require('gulp-rename'),
  sourcemaps    = require('gulp-sourcemaps'),
  include       = require("gulp-include"),
  notify        = require('gulp-notify'),

  // folders
  folder = {
    src: 'src/',
    build: './'
};

const buildInclude  = [
  // include common file types
  'src/**/*php',
  'src/acf-json/',
  // include specific files and folders
  'src/screenshot.png',
  'src/style.css',

  // exclude files and folders
  '!node_modules/**/*',
  '!assets/bower_components/**/*',
  '!assets'
];


const JS = folder.src + 'assets/js/app.js',
      JQUERY = folder.src + 'assets/js/jquery.js',
      SCSS = folder.src + 'assets/scss/*.scss',
      WP_ADMIN_SCSS = folder.build + 'inc/admin/admin-theme/assets/scss/*',
      IMAGES = folder.src + 'assets/images/**/*',
      VIDEOS = folder.src + 'assets/videos/**/*',
      SVG = folder.src + 'assets/images/**/*svg';

/**
 * Compress Images
 */
gulp.task('build-images', () => {

  let out = folder.build + 'assets/images/';

  return gulp.src(IMAGES)
    .pipe(newer(out))
    .pipe(imagemin({ optimizationLevel: 5 }))
    .pipe(svgo())
    .pipe(gulp.dest(out));
});


/**
 * Build Videos
 */
gulp.task('build-videos', () => {

  let out = folder.build + 'assets/videos/';

  return gulp.src(VIDEOS)
    .pipe(gulp.dest(out));
});

/**
 * SVG to PHP for partial includes
 */
gulp.task('svg2php', () => {

  let out = folder.build + 'assets/images/';

  return gulp.src(SVG)
    .pipe(rename({ extname: '.php' }))
    .pipe(gulp.dest(out));
});

/**
 * Build CSS/SCSS
 */
gulp.task('build-css', () => {

  let out = folder.build + 'assets/css/';

  let onError = function(err) {
    notify.onError({
      title:    "CSS Error",
      subtitle: "Nah Bruv!",
      message:  "Error: <%= error.message %>",
      sound:    "Beep"
    })(err);

    this.emit('end');
  };

  return gulp.src(SCSS)
  .pipe(plumber({errorHandler: onError}))
  .pipe(sourcemaps.init())
  .pipe(sass({
    outputStyle: 'compressed',
    imagePath: 'assets/images/',
    precision: 3,
    errLogToConsole: true,
    autoprefixer: {add: true},
  }))
  .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
  }))
  .pipe(rename({ suffix: '.min' }))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(out))
});


/**
 * Admin Theme SCSS Tasks
 */
gulp.task('build-admin-css', () => {

  let out = folder.build + 'inc/admin/admin-theme/assets/css/';

  const onError = function(err) {
    notify.onError({
        title:    "CSS Error",
        subtitle: "Nah Bruv!",
        message:  "Error: <%= error.message %>",
        sound:    "Beep"
    })(err);
    this.emit('end');
  };

  return gulp.src(WP_ADMIN_SCSS)
  .pipe(plumber({errorHandler: onError}))
  .pipe(sass({
    outputStyle: 'compressed',
    //imagePath: 'assets/images/',
    precision: 3,
    errLogToConsole: true,
    autoprefixer: {add: true},
  }))
  .pipe(sourcemaps.init())
  .pipe(autoprefixer())
  .pipe(rename({ suffix: '.min' }))
  //.pipe(sourcemaps.write('.'))
  .pipe(gulp.dest(out))
});


/**
 * JavaScript
 */
gulp.task('build-js', () => {

  let out = folder.build + 'assets/js/';

  var onError = function(err) {
    notify.onError({
      title:    "JS Error",
      subtitle: "Nah Bruv!",
      message:  "Error: <%= error.message %>",
      sound:    "Beep"
    })(err);

    this.emit('end');
  };

  return gulp.src(JS)
    .pipe(plumber({errorHandler: onError}))
    .pipe(sourcemaps.init())
    .pipe(include())
    .pipe (uglify ({
      mangle: false,
      compress: true,
      output: { beautify: false }
    }))
    .pipe(rename({ suffix: '.min' }))
    //.pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(out));
});

/**
 * Jquery
 */
gulp.task('build-jquery', () => {

  let out = folder.build + 'assets/js/';

  return gulp.src(JQUERY)
    .pipe(include())
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(folder.build + 'assets/js/'));
});

/**
 * JS Hint
 */
 gulp.task('jshint', () => {
   var onError = function(err) {
     notify.onError({
       title:    "JS Error",
       subtitle: "JS Hint!",
       message:  "Error: <%= error.message %>",
       sound:    "Beep"
     })(err);

     this.emit('end');
   };
   gulp.src(JS)
     .pipe(jshint({ esversion: 6 }))
     .pipe(jshint.reporter('default'))
     .pipe(plumber({errorHandler: onError}));
 });


/**
 * Wordpress Files
 */
// gulp.task('wp', () => {
//   const out = folder.build,
//   wpfiles = gulp.src(buildInclude)
//   .pipe(plumber(newer(out)));
//
//   return wpfiles.pipe(gulp.dest(out));
// });


/**
 * Run Tasks
 */
gulp.task('run', [
  'build-images',
  'build-videos',
  'build-css',
  'build-js',
  'build-jquery',
  'svg2php',
  'build-admin-css'
]);

/**
 * Watcher
 */
gulp.task('watch', () => {

  gulp.watch(folder.src + 'assets/images/**/*', ['build-images']);
  gulp.watch(folder.src + 'assets/scss/**/*', ['build-css']);
  gulp.watch(folder.build + 'inc/admin/admin-theme/assets/scss/**/*', ['build-admin-css']);
  gulp.watch(folder.src + 'assets/js/**/*', ['build-js']);
  gulp.watch(folder.src + 'assets/js/**/*', ['build-jquery']);
  gulp.watch(folder.src + 'assets/images/**/*', ['svg2php']);
  gulp.watch(folder.src + 'assets/videos/**/*', ['build-videos']);

});

/**
 * Gulp
 */
gulp.task('default', ['run', 'watch']);
