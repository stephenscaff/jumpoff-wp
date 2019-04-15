/**
 * Gulp Modules
 */
const gulp            = require('gulp'),
      autoprefixer    = require('gulp-autoprefixer'),
      babelify        = require('babelify'),
      browserify      = require('browserify'),
      buffer          = require('vinyl-buffer'),
      newer           = require('gulp-newer'),
      rename          = require('gulp-rename'),
      sass            = require('gulp-sass'),
      source          = require('vinyl-source-stream'),
      sourcemaps      = require('gulp-sourcemaps'),
      uglify          = require('gulp-uglifyes');

/**
 * Error Handler
 * Logs error and eats it up
 * to keep stuff running.
 */
function handleError(err) {
  console.log(err.toString());
  this.emit('end');
}



function bundleJS(file) {
   let url = `src/assets/js/${file}.js`;
   return browserify(url).transform('babelify', {
    presets: [
      ['@babel/preset-env', {
        targets: {
          browsers: ['last 2 versions', 'ie >= 11']
        }
      }]
    ]
  })
}

/**
 * JavaScript
 */
gulp.task('build-js', () => {

  let bundler = bundleJS('app');

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
    .pipe(sourcemaps.write('./assets/js/maps/'))
    .pipe(gulp.dest('./assets/js/'));
});

/**
 * Jquery
 */
gulp.task('build-jquery', () => {

  return gulp.src('src/assets/js/jquery.js')
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(newer('./assets/js/'))
    .pipe(gulp.dest('./assets/js/'));
});

/**
 * Build CSS/SCSS
 */
gulp.task('build-css', () => {

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
        browsers: ['last 2 versions'],
        cascade: false
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./assets/css/'))
});

/**
 * Admin Theme SCSS Tasks
 */
gulp.task('build-admin-css', () => {

  return gulp.src('inc/admin/admin-theme/assets/scss/*')
    .pipe(sass({
      outputStyle: 'compressed',
      //imagePath: 'assets/images/',
      precision: 3,
      errLogToConsole: true,
      autoprefixer: {add: true},
    }))
    .on('error', handleError)
    .pipe(autoprefixer())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('inc/admin/admin-theme/assets/css/'))
});

/**
 * Compress Images
 */
gulp.task('build-images', () => {

  return gulp.src('src/assets/images/**/*')
    .pipe(newer('./assets/images/'))
    .pipe(gulp.dest('./assets/images/'));
});

/**
 * Build Videos
 */
gulp.task('build-videos', () => {

  return gulp.src('src/assets/videos/**/*')
    .pipe(newer('./assets/videos/'))
    .pipe(gulp.dest('./assets/videos/'));
});

/**
 * SVG to PHP for partial includes
 */
gulp.task('svg2php', () => {

  return gulp.src('src/assets/images/**/*svg')
    .pipe(rename({ extname: '.php' }))
    .pipe(gulp.dest('./assets/images/'));
});

/**
 * Runner
 */
gulp.task('run', [
  'build-js',
  'build-css',
  'build-admin-css',
  'build-images',
  'build-videos',
  'svg2php'
]);

/**
 * Watcher
 */
gulp.task('watch', () => {
  gulp.watch('src/assets/js/**/*', ['build-js']);
  // gulp.watch('src/assets/js/**/*', ['build-jquery']);
  gulp.watch('src/assets/scss/**/*', ['build-css']);
  gulp.watch('./inc/admin/admin-theme/assets/scss/**/*', ['build-admin-css']);
  gulp.watch('src/assets/images/**/*', ['build-images']);
  gulp.watch('src/assets/images/**/*', ['svg2php']);
  gulp.watch('src/assets/videos/**/*', ['build-videos']);
});

/**
 * Gulp
 */
gulp.task('default', ['run', 'watch']);
