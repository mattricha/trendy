var gulp = require('gulp');
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var less = require('gulp-less');
var minify = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');

var paths = {
    'dev': {
        'sass': './resources/assets/sass/',
        'less': './resources/assets/less/',
        'js': './resources/assets/js/',
        'vendor': './resources/assets/vendor/'
    },
    'production': {
        'css': './public/assets/css/',
        'js': './public/assets/js/'
    }
};

gulp.task('sass', function() {
    return gulp.src(paths.dev.sass+'*.scss')
        .pipe(sass())
        .pipe(gulp.dest(paths.dev.sass));
});

gulp.task('less', function() {
    return gulp.src(paths.dev.less+'*.less')
        .pipe(less())
        .pipe(gulp.dest(paths.dev.less));
});

gulp.task('css', function() {
    return gulp.src([
        paths.dev.sass+'app.css',
        paths.dev.less+'app.css'
        ])
        .pipe(concat('app.min.css'))
        .pipe(minify({keepSpecialComments:0}))
        .pipe(gulp.dest(paths.production.css));
});

gulp.task('lint', function() {
    return gulp.src(paths.dev.js+'*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

gulp.task('js', function(){
    return gulp.src([
        paths.dev.vendor+'jquery/dist/jquery.js',
        paths.dev.vendor+'jquery-ui/jquery-ui.js',
        paths.dev.vendor+'angular/angular.js',
        paths.dev.vendor+'angular-route/angular-route.js',
        paths.dev.vendor+'bootstrap/dist/js/bootstrap.js',
        paths.dev.vendor+'angular-ui-bootstrap-bower/ui-bootstrap.js',
        paths.dev.vendor+'angular-ui-bootstrap-bower/ui-bootstrap-tpls.js',
        //paths.dev.vendor+'angular-bootstrap/ui-bootstrap.js',
        paths.dev.vendor+'angular-file-upload/angular-file-upload.js',
        paths.dev.vendor+'angular-smart-table/dist/smart-table.js',
        paths.dev.vendor+'angular-ui-sortable/sortable.js',
        paths.dev.vendor+'es5-shim/dist/js/es5-shim.js',
        paths.dev.vendor+'es5-shim/dist/js/es5-sham.js',
        paths.dev.vendor+'modernizr/modernizr.js',
        paths.dev.vendor+'masonry/dist/masonry.pkgd.js',
        paths.dev.vendor+'angular-masonry/angular-masonry.js',
        paths.dev.vendor+'imagesloaded/imagesloaded.pkgd.js',
        paths.dev.vendor+'angular-animate/angular-animate.js',
        paths.dev.vendor+'v-accordion/dist/v-accordion.js',
        paths.dev.vendor+'angular-utils-pagination/dirPagination.js',
        paths.dev.js+'*.js'
        ])
        .pipe(concat('app.min.js'))
        //.pipe(uglify())
        .pipe(gulp.dest(paths.production.js));
});

gulp.task('watch', function() {
  gulp.watch(paths.dev.sass + '/*.scss', ['sass','css']);
  gulp.watch(paths.dev.less + '/*.less', ['less','css']);
  gulp.watch(paths.dev.js + '/*.js', ['lint', 'js']);
});

gulp.task('default', ['sass','less','css','lint','js','watch']);
