var gulp = require('gulp');
// create new instance of BrowserSync
var browserSync = require('browser-sync').create();

gulp.task('watch', function (gulpCallback) {
    browserSync.init({
        // Directory to start the server in
        server: './',
        // Launch default browser. I prefer chrome.
        open: true
    }, function callback() {
        // Monitor html and Javascript and reload browsers when it changes
        gulp.watch('./index.html', browserSync.reload);

        // watch css and stream to BrowserSync when it changes
        gulp.watch('./css/*', function () {
            // grab css files and send them into browserSync.stream
            // this injects the css into the page
            gulp.src('./css/*')
                .pipe(browserSync.stream());
        });

        // notify gulp that this task is done
        gulpCallback();
    });
});
