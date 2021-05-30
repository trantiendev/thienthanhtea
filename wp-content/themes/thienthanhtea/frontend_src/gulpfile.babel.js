import {
  src,
  dest,
  watch,
  series,
  parallel,
 } from 'gulp';
import nunjucks from 'gulp-nunjucks';
import sass from 'gulp-sass';
import sourcemap from 'gulp-sourcemaps';
import terser from 'gulp-terser-js';
import autoprefixer from 'gulp-autoprefixer';
import scssLint from 'gulp-scss-lint';
import browserify from 'browserify';
import sourceStream from 'vinyl-source-stream';
import buffer from 'vinyl-buffer';
import uglify from 'gulp-uglify';
import babelify from 'babelify';
import browser from "browser-sync";
import gtil from 'gulp-util';
import clean from 'gulp-clean';
import plumber from 'gulp-plumber';

const browserSync = browser.create();
const init = {
  srcPath: './src',
  destPath: './public'
};

export function template() {
  return src([`${init.srcPath}/html/**/*.html`, `!${init.srcPath}/html/shared/*`, `!${init.srcPath}/html/layout/*`])
    .pipe(nunjucks.compile().on('error', () => {
      gtil.log(`[${err.plugin}] There is an error from ${err.fileName}`)
    }))
    .pipe(dest(`${init.destPath}/`))
}

export function images() {
  return src(`${init.srcPath}/img/**/*.{gif,jpg,png,svg,ico}`)
      .pipe(dest(`${init.destPath}/img`))
}

export function styles(done) {
  src(`${init.srcPath}/scss/**/*.scss`)
      .pipe(plumber({
        handleError: err => {
        console.log(err);
        this.emit('end');
        }
      }))
      .pipe(scssLint({ 'config': '.scss-lint.yml' }))
      .pipe(sourcemap.init())
      .pipe(sass({ outputStyle: 'compressed' }))
      .pipe(autoprefixer())
      .pipe(sourcemap.write())
      .pipe(dest(`${init.destPath}/css`))
      .pipe(browserSync.stream())

  done()
}

export function scripts() {
  return browserify({
    entries: `${init.srcPath}/js/main.js`,
    debug: false
  })
    .transform(babelify, {
      'presets': ['@babel/preset-env'],
      'plugins': ['@babel/plugin-transform-runtime']
    })
    .transform(['glslify', { global: true }])
    .bundle()
    .on('error', function(err) {
      console.log(err);
      this.emit('end');
    })
    .pipe(sourceStream('main.js'))
    .pipe(buffer())
    .pipe(sourcemap.init({loadMaps: true}))
    .pipe(terser())
    .pipe(uglify())
    .pipe(sourcemap.write())
    .pipe(dest(`${init.destPath}/js`))
}

export function watchTask() {
  browserSync.init({
    server: {
      baseDir: `${init.destPath}`
    },
    port: 8001
  })

  watch(`${init.srcPath}/html/**/*.html`, template).on('change', browserSync.reload);
  watch(`${init.srcPath}/scss/**/*.scss`, styles);
  watch(`${init.srcPath}/js/**/*.js`, scripts).on('change', browserSync.reload);
}

function cleanDir(done) {
  src([`${init.destPath}/*`, `!${init.destPath}/img`])
    .pipe(clean())

  done()
}

exports.build = series(
  cleanDir,
  parallel(template, images, styles, scripts)
);

exports.default = series(
  parallel(template, images, styles, scripts),
  watchTask
);

exports.deploy = series(function(callback) {
  parallel(cleanDir, template, images, styles, scripts, callback());
})
