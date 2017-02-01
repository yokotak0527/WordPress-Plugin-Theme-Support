let gulp     = require('gulp');
let sassConf = require('withpro-gulp-sass');
let jsConf   = require('withpro-gulp-js');

sassConf.path = {
  'project' : '/',
    'src' : {
      'sass'      : 'asset/sass',
      'sassMixin' : 'asset/sass/mixin',
      'font'      : 'asset/font',
      'iconfont'  : 'asset/font/icon',
      'lib'       : ['lib/sass'],
    },
    'dest' : {
      'css'      : 'src/css',
      'image'    : 'src/img',
      'font'     : 'src/font',
      'iconfont' : 'src/font/icon'
    }
}
jsConf.path = {
  'project' : '/',
    'src' : { 'js' : 'asset/js' },
    'dest' : { 'js' : 'src/js' }
}

sassConf.init();
jsConf.init();

gulp.task('build', ['js-build', 'sass-build']);
gulp.task('watch', ['js-watch', 'sass-watch']);
