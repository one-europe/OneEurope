module.exports = function (grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
				compress: {}
			},
			build: {
				src: '../src/js/app/*.js',
				dest: '../user/themes/euro/js/scripts.min.js'
			}
		},
		
		concat: {
			dist: {
				files: {
					'../user/themes/euro/js/plugins.min.js': [
						'../src/js/lib/jquery-1.11.1.min.js',
						// '../src/js/lib/superfish.min.js',
						// '../src/js/lib/jquery.nailthumb.1.1.min.js',
						'../src/js/lib/imgLiquid.min.js',
						'../src/js/lib/jquery-ui-1.10.4.custom.min.js',
						'../src/js/lib/jquery-ui-tabs-extend.min.js'
					],
					'../user/themes/euro/js/scripts.min.js': '../src/js/app/*.js'
				}
			}
		},

		less: {
			dev: {
				options: { paths: ['www/css'], compress: true },
				files: {
					'../user/themes/euro/css/main.css':
					[
						'../src/less/reset.less',
						'../src/less/main.less',
						'../src/less/jquery.nailthumb.1.1.less'
					]
				}
			}
		},

		watch: {
			scripts: {
				files: ['../src/js/app/*.js', '../src/less/*.less'],
				tasks: ['jshint', 'less:dev', 'concat', 'uglify']
			}
		},

		jshint: { options: { jshintrc: '.jshintrc' } }
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-less');

	grunt.registerTask('default', ['jshint', 'less:dev', 'concat', 'uglify']);

};