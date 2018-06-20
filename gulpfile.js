const argv         = require('minimist')(process.argv.slice(2));
const gulp         = require('gulp');
const del          = require('del');
const rename       = require('gulp-rename');
const sass         = require('gulp-sass');
const postcss      = require('gulp-postcss');
const pixrem       = require('pixrem');
const autoprefixer = require('autoprefixer');
const flexibility  = require('postcss-flexibility');
const cssmin       = require('gulp-cssmin');
const browserSync  = require('browser-sync').create();

const DIST = [
    '**',
    '!.**',
    '!dist{,/**}',
    '!node_modules{,/**}',
    '!sass{,/**}',
    '!src{,/**}',
    '!gulpfile.js',
    '!package.json',
    '!package-lock.json'
];

gulp.task('clean', function() {
    return del(['css/', 'dist/']);
});

gulp.task('sass', function() {
    var postCSSplugins = [
        require('postcss-flexibility'),
        pixrem(),
        autoprefixer({browsers: ['> 1%', 'last 3 versions', 'ie 8-10', 'not ie <= 7']})
    ];
    return gulp.src('sass/*.scss')
    .pipe(sass({
        includePaths: 'sass',
        outputStyle: 'expanded'
    }).on('error', sass.logError))
    .pipe(postcss(postCSSplugins))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('sass', function css() {
    return gulp.src(['css/*.css', '!css/*.min.css'])
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

gulp.task('dist', function() {
    return gulp.src(DIST)
    .pipe(gulp.dest('dist/'));
});

gulp.task('default', function() {
    browserSync.init({
        ui: false,
        notify: false,
        online: false,
        open: false,
        host: argv.URL || 'localhost',
        proxy: argv.URL || 'localhost',
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
});

if (argv.production) {
    gulp.task('build', gulp.series('clean', 'styles', 'dist'));
} else {
    gulp.task('build', gulp.series('clean', 'sass'));
}
