/**
 * Gulp for WP
 */
const gulp            = require('gulp'),
      autoprefixer    = require('gulp-autoprefixer'),
      babelify        = require('babelify'),
      browserify      = require('browserify'),
      buffer          = require('vinyl-buffer'),
      del             = require('del'),
      newer           = require('gulp-newer'),
      rename          = require('gulp-rename'),
      sass            = require('gulp-sass'),
      source          = require('vinyl-source-stream'),
      sourcemaps      = require('gulp-sourcemaps'),
      uglify          = require('gulp-uglifyes');


// Error handler
function handleError(err) {
  console.log(err.toString());
  this.emit('end');
}

// Cleanup
function clean() {
  return del(["dist/"]);
}

// CSS
function buildCSS() {
  return gulp.src('src/assets/scss/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sass({
    outputStyle: 'compressed',
    imagePath: 'assets/images/',
    precision: 3,
    errLogToConsole: true,
    autoprefixer: {add: true},
  }))
  .on('error', handleError)
  .pipe(autoprefixer({
      cascade: false
  }))
  .pipe(rename({ suffix: '.min' }))
  .pipe(sourcemaps.write('.'))
  .pipe(gulp.dest('./assets/css/'))
}

// Build Admin CSS
function buildAdminCSS() {

  return gulp.src('inc/Admin/AdminTheme/assets/scss/*')
    .pipe(sass({
      outputStyle: 'compressed',
      precision: 3,
      errLogToConsole: true,
      autoprefixer: { add: true },
    }))
    .on('error', handleError)
    .pipe(autoprefixer())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('inc/Admin/AdminTheme/assets/css/'))
}

// Build JS
// uses browserify for js modules and babel for transpiling
function buildJS() {
  const bundler = browserify('src/assets/js/app.js').transform(
    'babelify',
    { presets: ['@babel/preset-env'] }
  )
  return bundler.bundle()
    .on('error', handleError)
    .pipe(source('app.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init())
      .pipe(uglify({
        mangle: false,
        compress: false,
        output: {
          beautify: true
        }
      }))
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./assets/js/'));
}

// SVG 2 PHP
function svg2php() {
  return gulp.src('src/assets/images/**/*svg')
    .pipe(rename({ extname: '.php' }))
    .pipe(gulp.dest('./assets/images/'));
}

// Images
function buildImages() {
  return gulp.src('src/assets/images/', { allowEmpty: true })
    .pipe(newer('dist/assets/images/'))
    .pipe(gulp.dest('dist/assets/images/'))
}

// Build Videos
function buildVideos() {

  return gulp.src('src/assets/videos/**/*')
    .pipe(newer('./assets/videos/'))
    .pipe(gulp.dest('./assets/videos/'));
}

// Watcher
function watch() {
  gulp.watch('src/assets/scss/**/*', buildCSS);
  gulp.watch('./inc/Admin/AdminTheme/assets/scss/**/*', buildAdminCSS);
  gulp.watch('src/assets/js/**/*', buildJS);
  gulp.watch('src/assets/images/**/*', buildImages);
  gulp.watch('src/assets/images/**/*', svg2php);
  gulp.watch('src/assets/videos/**/*', buildVideos);
}

// Build
var build = gulp.parallel(
  clean,
  buildCSS,
  buildAdminCSS,
  buildJS,
  buildImages,
  svg2php,
  buildVideos,
  watch
);

gulp.task(build);
gulp.task('default', build);
