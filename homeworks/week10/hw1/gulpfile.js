var gulp = require('gulp');
var gulpSass = require('gulp-sass');
var gulpUglify = require('gulp-uglify');
var gulpBabel = require('gulp-babel');
var rename = require("gulp-rename");
var clean = require('gulp-clean');

gulp.task('script', ['clean'], () => {
    return gulp.src('script.js')
        .pipe(gulpBabel({
            presets: ['env']
        }))
        .pipe(gulp.dest('dist'))
        .pipe(gulpUglify())
        .pipe(rename({
        	suffix: '-mini'
        }))
        .pipe(gulp.dest('dist'));
});

gulp.task('style', ['clean'], ()=>{
	return gulp.src('style.scss')
		.pipe(gulpSass())
		.pipe(gulp.dest('dist'))
		.pipe(gulpSass({
			outputStyle: 'compressed'
		}))
		.pipe(rename({
			suffix: '-mini'
		}))
		.pipe(gulp.dest('dist'));
});

gulp.task('clean', ()=>{
	return gulp.src('dist')
		.pipe(clean());
});

gulp.task('default', ['script','style']);
