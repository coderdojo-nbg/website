/* global module:false */
module.exports = function(grunt) {
	var fs						= require('fs');
	var mozjpeg					= require('imagemin-mozjpeg');
	var sassRename				= function (dest, src) {
		var folder				= src.substring(0, src.lastIndexOf('/'));
		var filename    		= src.substring(src.lastIndexOf('/'), src.length);
		filename    			= filename.substring(0, filename.lastIndexOf('.'));
		return dest + '/' + folder + filename + '.css';
	};
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	grunt.initConfig({
		
		sass					: {
			options				: {
				sourceMap		: true
			},
			above				: {
				files			: [{
					expand		: true,
					cwd			: 'fileadmin/coderdojo/.templates/sass/above',
		 			src			: ['**/*.scss'],
					dest		: 'fileadmin/coderdojo/.templates/css/above',
					rename      : sassRename
				}],
				options: {
					sourcemap	: true,
					style		: 'nested'
				}
			},
			below				: {
				files			: [{
					expand		: true,
					cwd			: 'fileadmin/coderdojo/.templates/sass/below',
		 			src			: ['**/*.scss'],
					dest		: 'fileadmin/coderdojo/.templates/css/below',
					rename      : sassRename
				}],
				options: {
					sourcemap	: true,
					style		: 'nested'
				}
			},
			noconcat			: {
				files			: [{
					expand		: true,
					cwd			: 'fileadmin/coderdojo/.templates/sass/noconcat',
		 			src			: ['**/*.scss'],
					dest		: 'fileadmin/coderdojo/.templates/css/noconcat',
					rename      : sassRename
				}],
				options: {
					sourcemap	: true,
					style		: 'nested'
				}
			}
		},

		iconizr					: {
			dist				: {
				src				: ['**/*.svg'],
				dest			: 'fileadmin/coderdojo',
				expand			: true,
				cwd				: 'fileadmin/coderdojo/.templates/icons',
				options			: {
					log			: 'verbose',
					shape		: {
						dest	: 'icons',
						transform			: [
							{svgo: {plugins: [{convertPathData: false}]}}
						],
					},
					icons				: {
						dest			: 'css',
						prefix			: '.icon-%s',
//						mixin			: 'icon',
						common			: 'icon',
						dimensions		: '-dims',
						layout			: 'vertical',
						sprite			: 'icons/icons.svg',
						render			: {
							scss		: {
								dest	: '../.templates/sass/noconcat/icon'
							}
						},
						bust			: false,
						preview			: 'icons/preview',
						loader			: {
							dest		: 'js/icons-loader.html',
							css			: 'icon.%s.css'
						}
					}
				}
			}
		},
		
		favicons				: {
			options				: {
				html			: 'fileadmin/coderdojo/favicons/favicons.html',
				HTMLPrefix		: '/fileadmin/coderdojo/favicons/',
				precomposed		: false,
				firefox			: true,
				firefoxManifest : 'fileadmin/coderdojo/favicons/coderdojo.webapp',
				appleTouchBackgroundColor : '#222222'
			},
			icons				: {
				src				: 'fileadmin/coderdojo/.templates/favicon/favicon.png',
				dest			: 'fileadmin/coderdojo/favicons'
		    }
		},
		
		
		copy					: {
			
			favicon: {
				src				: 'fileadmin/coderdojo/favicons/favicon.ico',
				dest			: 'favicon.ico'
			}
			
		},
		
		replace					: {
			
			favicon: {
				src				: ['fileadmin/coderdojo/favicons/favicons.html'],
				overwrite		: true,
				replacements	: [{
					from		: /[\t\r\n]+/g,
					to			: ''
			    }, {
					from		: /<link rel="shortcut icon".*/g,
					to			: '<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/><link rel="icon" href="/favicon.ico" type="image/x-icon"/>'
			    }]
			}
			
		},
		
		autoprefixer			: {
			options				: {
				browsers		: ['last 3 versions', 'ie 8'],
				map				: true
			},
			general				: {
				src				: ['fileadmin/coderdojo/css/coderdojo.css']
			},
			above				: {
				src				: ['fileadmin/coderdojo/css/coderdojo-above.css']
			},
			below				: {
				src				: ['fileadmin/coderdojo/css/coderdojo-below.css']
			},
			noconcat			: {
				expand			: true,
      			flatten			: true,
				src				: 'fileadmin/coderdojo/.templates/css/noconcat/*.css',
				dest			: 'fileadmin/coderdojo/css/'
			}
		},
		
		cssmin					: {
			general				: {
				files			: {
					'fileadmin/coderdojo/css/coderdojo.min.css' : ['fileadmin/coderdojo/css/coderdojo.css']
				}
			},
			above				: {
				files			: {
					'fileadmin/coderdojo/css/coderdojo-above.min.css' : ['fileadmin/coderdojo/css/coderdojo-above.css']
				}
			},
			below				: {
				files			: {
					'fileadmin/coderdojo/css/coderdojo-below.min.css' : ['fileadmin/coderdojo/css/coderdojo-below.css']
				}
			},
			noconcat			: {
				expand			: true,
				cwd				: 'fileadmin/coderdojo/css',
				src				: ['**/*.css', '!**/*.min.css', '!coderdojo.css', '!coderdojo-above.css', '!coderdojo-below.css'],
				dest			: 'fileadmin/coderdojo/css',
				rename          : function (dest, src) {
					var folder  = src.substring(0, src.lastIndexOf('/')),
					filename    = src.substring(src.lastIndexOf('/'), src.length);
					filename    = filename.substring(0, filename.lastIndexOf('.'));
					return dest + '/' + folder + filename + '.min.css';
				}
			}
		},

		concat_sourcemap		: {
			options: {
	          sourceRoot		: '/'
	        },
			general 			: {
				src				: ['fileadmin/coderdojo/.templates/css/*.css'],
				dest			: 'fileadmin/coderdojo/css/coderdojo.css'
			},
			above				: {
				src				: ['fileadmin/coderdojo/.templates/css/above/*.css'],
				dest			: 'fileadmin/coderdojo/css/coderdojo-above.css'
			},
			below				: {
				src				: ['fileadmin/coderdojo/.templates/css/below/*.css'],
				dest			: 'fileadmin/coderdojo/css/coderdojo-below.css'
			},
			javascript			: {
				expand			: true,
				cwd				: 'fileadmin/coderdojo/.templates/js/',
				src				: ['**/*.js'],
				dest			: 'fileadmin/coderdojo/js',
				ext				: '.js',
				extDot			: 'last',
				rename          : function (dest, src) {
					return dest + '/' + ((src.indexOf('/') >= 0) ? (src.substring(0, src.indexOf('/'))  + '.js') : src);
				}
			}
		},

		uglify : {
			options: {
	          sourceMap			: true,
	          sourceMapIn		: function(input) {
	          	return fs.existsSync(input + '.map') ? (input + '.map') : null;
	          }
	        },
			javascript          : {
				expand          : true,
				cwd             : 'fileadmin/coderdojo/js/',
				src             : ['**/*.js', '!**/*.min.js'],
				dest            : 'fileadmin/coderdojo/js/',
				ext				: '.min.js',
				extDot			: 'last'
			}
		},
		
		imageminbackup : {
			images: {
				options: {
					optimizationLevel	: 3,
						progressive		: true,
						use				: [mozjpeg()],
						backup			: '.backup'
				},
				files: [{
					expand		: true,
					cwd			: 'fileadmin/',
					src			: ['**/*.{png,PNG,jpg,JPG,jpeg,JPEG,gif,GIF}'],
					dest		: 'fileadmin/'
				}, {
					expand		: true,
					cwd			: 'uploads/',
					src			: ['**/*.{png,PNG,jpg,JPG,jpeg,JPEG,gif,GIF}'],
					dest		: 'uploads/'
				}]
			}
		},
		
		clean					: {
			general				: ['fileadmin/coderdojo/css/coderdojo.css', 'fileadmin/coderdojo/css/coderdojo.min.css'],
			above				: ['fileadmin/coderdojo/css/coderdojo-above.css', 'fileadmin/coderdojo/css/coderdojo-above.min.css'],
			below				: ['fileadmin/coderdojo/css/coderdojo-below.css', 'fileadmin/coderdojo/css/coderdojo-below.min.css'],
			favicon				: ['favicon.ico']
		},
		
		validation: {
			options: {
				reset					: grunt.option('reset') || false,
					path				: '.validation/validation-status.json',
					reportpath			: '.validation/validation-report.json',
					stoponerror			: false,
					remotePath			: 'http://coderdojo-nbg.org',
					remoteFiles			: '.validation/validation-files.json',
					relaxerror			: ['Bad value X-UA-Compatible for attribute http-equiv on element meta.'],
					generateReport		: true,
					errorHTMLRootDir	: '.validation/errors'
			},
			files						: {
				src						: ['*']
			}
		},
		
		watch : {
			// Watch Sass resource changes
			sassAbove : {
				files : ['fileadmin/coderdojo/.templates/sass/above/**/*.scss', 'fileadmin/coderdojo/.templates/sass/common/**/*.scss'],
				tasks : ['sass:above']
			},
			sassBelow : {
				files : ['fileadmin/coderdojo/.templates/sass/below/**/*.scss', 'fileadmin/coderdojo/.templates/sass/common/**/*.scss'],
				tasks : ['sass:below']
			},
			sassNoconcat : {
				files : ['fileadmin/coderdojo/.templates/sass/noconcat/**/*.scss', 'fileadmin/coderdojo/.templates/sass/common/**/*.scss'],
				tasks : ['sass:noconcat']
			},
			
			// Watch changing CSS resources
			cssGeneral : {
				files : ['fileadmin/coderdojo/.templates/css/*.css'],
				tasks : ['clean:general', 'concat_sourcemap:general', 'autoprefixer:general', 'cssmin:general'],
				options : {
					spawn : true
				}
			},
			cssAbove : {
				files : ['fileadmin/coderdojo/.templates/css/above/*.css'],
				tasks : ['clean:above', 'concat_sourcemap:above', 'autoprefixer:above', 'cssmin:above'],
				options : {
					spawn : true
				}
			},
			cssBelow : {
				files : ['fileadmin/coderdojo/.templates/css/below/*.css'],
				tasks : ['clean:below', 'concat_sourcemap:below', 'autoprefixer:below', 'cssmin:below'],
				options : {
					spawn : true
				}
			},
			cssNoconcat : {
				files : ['fileadmin/coderdojo/.templates/css/noconcat/*.css'],
				tasks : ['autoprefixer:noconcat', 'cssmin:noconcat'],
				options : {
					spawn : true
				}
			},
			
			// Watch SVG icon changes
			iconizr : {
				files : ['fileadmin/coderdojo/.templates/icons/**/*.svg'],
				tasks : ['iconizr'],
				options : {
					spawn : true
				}
			},
			
			// Watch & uglify changing JavaScript resources
			javascript : {
				files : ['fileadmin/coderdojo/.templates/js/**/*.js'],
				tasks : ['concat_sourcemap:javascript', 'uglify'],
				options : {
					spawn : true
				}
			},
			
			grunt: {
				files: ['Gruntfile.js'],
			    options: {
			      reload: true
			    }
			}
		}
	});

	// Default task.
	grunt.registerTask('default', ['iconizr', 'sass', 'css', 'js']);
	grunt.registerTask('css', ['clean:general', 'clean:above', 'clean:below',
								'concat_sourcemap:general', 'concat_sourcemap:above', 'concat_sourcemap:below',
								'autoprefixer',
								'cssmin']);
	grunt.registerTask('js', ['concat_sourcemap:javascript', 'uglify']);
	grunt.registerTask('icons', ['iconizr']);
	grunt.registerTask('favicon', ['clean:favicon', 'favicons', 'copy:favicon', 'replace:favicon']);
	
};