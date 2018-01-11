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
  'src/**/*.php',
  'src/acf-json/',
  // include specific files and folders
  'src/screenshot.png',
  'src/style.css',

  // exclude files and folders
  '!src/assets/scss/**/*',
  '!node_modules/**/*',
  '!assets/bower_components/**/*',
  '!assets'
];


/**
 * Compress Images
 */
gulp.task('images', () => {
  const out = folder.build + 'assets/images/';

  return gulp.src(folder.src + 'assets/images/**/*')
    .pipe(newer(out))
    .pipe(imagemin({ optimizationLevel: 5 }))
    .pipe(svgo())
    .pipe(gulp.dest(out));
});


/**
 * SVG to PHP for partial includes
 */
gulp.task('videos', () => {
  const out = folder.build + 'assets/videos/';

  return gulp.src(folder.src + 'assets/videos/**/*')
    .pipe(gulp.dest(out));
});

/**
 * SVG to PHP for partial includes
 */
gulp.task('svg2php', () => {
  const out = folder.build + 'assets/images/';

  return gulp.src(folder.src + 'assets/images/**/*svg')
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

  return gulp.src(folder.src + 'assets/scss/*.scss')
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

  return gulp.src(folder.src + 'inc/admin/admin-theme/assets/scss/*.scss')

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

  return gulp.src(folder.src + 'assets/js/app.js')
    .pipe(plumber({errorHandler: onError}))
    .pipe(sourcemaps.init())
    .pipe(include())
    .pipe (uglify ({
      mangle: false,
      compress: false,
      output: { beautify: true }
    }))
    .pipe(rename({ suffix: '.min' }))
    //.pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(folder.build + 'assets/js/'));
});

/**
 * Jquery
 */
gulp.task('jquery', () => {

  return gulp.src(folder.src + 'assets/js/jquery.js')
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
   gulp.src(folder.src + 'assets/js/**/*')
     .pipe(jshint({ esversion: 6 }))
     .pipe(jshint.reporter('default'))
     .pipe(plumber({errorHandler: onError}));
 });


/**
 * Wordpress Files
 */
gulp.task('wp', () => {
  const out = folder.build,
  wpfiles = gulp.src(buildInclude)
  .pipe(plumber(newer(out)));

  return wpfiles.pipe(gulp.dest(out));
});


/**
 * Run Tasks
 */
gulp.task('run', [
  'images',
  'videos',
  'scss',
  'js',
  'wp',
  'svg2php',
  'wp_admin_scss'
]);

/**
 * Watcher
 */
gulp.task('watch', () => {

  gulp.watch(folder.src + 'assets/images/**/*', ['images']);
  gulp.watch(folder.src + 'assets/scss/**/*', ['scss']);
  gulp.watch(folder.src + 'inc/admin/admin-theme/assets/scss/**/*', ['wp_admin_scss']);
  gulp.watch(folder.src + 'assets/js/**/*', ['js']);
  gulp.watch(folder.src + 'assets/js/**/*', ['jquery']);
  gulp.watch(folder.src + '**', ['wp']);
  gulp.watch(folder.src + 'assets/images/**/*', ['svg2php']);
  gulp.watch(folder.src + 'assets/videos/**/*', ['videos']);

});

/**
 * Gulp
 */
gulp.task('default', ['run', 'watch']);
