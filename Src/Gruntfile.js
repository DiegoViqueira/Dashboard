module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
	concat: {
    js: { //target
        src: ['js/Main.js', 'js/controllers/*.js', 'js/Closure.js'],
        dest: 'js/Main.Concat.js'
    }
	},
    uglify: {
      options: {
        banner: '/*! Reclamo Online <%= grunt.template.today("yyyy-mm-dd") %> \n Autor: Diego Viqueira \n Date: 01-05-2016 \n Copyrigths: Reclamo On-line */\n'
      },
      build: {
        src: 'js/Main.Concat.js',
        dest: 'js/ReclamoOnline.min.js'
      }
    }
  });

  
     //load grunt tasks
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    

    //register grunt default task
    grunt.registerTask('default', ['concat', 'uglify']);

};