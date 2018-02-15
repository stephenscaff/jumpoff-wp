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
gulp.task('images', () => {
  const out = folder.build + 'assets/images/';

  return gulp.src(IMAGES)
    .pipe(newer(out))
    .pipe(imagemin({ optimizationLevel: 5 }))
    .pipe(svgo())
    .pipe(gulp.dest(out));
});


/**
 * Videos
 */
gulp.task('videos', () => {
  const out = folder.build + 'assets/videos/';

  return gulp.src(VIDEOS)
    .pipe(gulp.dest(out));
});

/**
 * SVG to PHP for partial includes
 */
gulp.task('svg2php', () => {
  const out = folder.build + 'assets/images/';

  return gulp.src(SVG)
    .pipe(rename({ extname: '.php' }))
    .pipe(gulp.dest(out));
});

/**
 * SCSS Tasks
 */
gulp.task('scss', () => {

  var onError = function(err) {
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
  .pipe(gulp.dest(folder.build + 'assets/css/'))
});


/**
 * Admin Theme SCSS Tasks
 */
gulp.task('wp_admin_scss', () => {
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
  .pipe(gulp.dest(folder.build + 'inc/admin/admin-theme/assets/css/'))
});


/**
 * JavaScript
 */
gulp.task('js', () => {

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
    .pipe(gulp.dest(folder.build + 'assets/js/'));
});

/**
 * Jquery
 */
gulp.task('jquery', () => {

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
  'images',
  'videos',
  'scss',
  'js',
  'jquery',
  'svg2php',
  'wp_admin_scss'
]);

/**
 * Watcher
 */
gulp.task('watch', () => {

  gulp.watch(folder.src + 'assets/images/**/*', ['images']);
  gulp.watch(folder.src + 'assets/scss/**/*', ['scss']);
  gulp.watch(folder.build + 'inc/admin/admin-theme/assets/scss/**/*', ['wp_admin_scss']);
  gulp.watch(folder.src + 'assets/js/**/*', ['js']);
  gulp.watch(folder.src + 'assets/js/**/*', ['jquery']);
  gulp.watch(folder.src + 'assets/images/**/*', ['svg2php']);
  gulp.watch(folder.src + 'assets/videos/**/*', ['videos']);

});

/**
 * Gulp
 */
gulp.task('default', ['run', 'watch']);
