/* global module, require */

module.exports = function(grunt) {

	var pkg = grunt.file.readJSON( 'package.json' );

	var local_url = 'http://wp.dev';

	if ( grunt.file.exists( '.dev/local-url' ) ) {

		local_url = grunt.file.read( '.dev/local-url' ).trim();

	}

	grunt.initConfig({

		pkg: pkg,

		autoprefixer: {
			options: {
				browsers: [
					'Android >= 2.1',
					'Chrome >= 21',
					'Edge >= 12',
					'Explorer >= 7',
					'Firefox >= 17',
					'Opera >= 12.1',
					'Safari >= 6.0'
				],
				cascade: false
			},
			dist: {
				src: [ '*.css', '!ie.css' ]
			}
		},

		browserSync: {
			dev: {
				bsFiles: {
					src: [
						'*.css',
						'**/*.php',
						'*.js'
					]
				},
				options: {
					proxy: local_url, // this is read from the file .dev/local-url
					watchTask: true
				}
			}
		},

		copy: {
			main: {
				expand: true,
				src: [
					'node_modules/social-logos/icon-font/*.eot',
					'node_modules/social-logos/icon-font/*.woff2',
					'node_modules/social-logos/icon-font/*.ttf'
				],
				dest: 'assets/fonts',
				filter: 'isFile',
				flatten: true
			}
		},

		cssjanus: {
			theme: {
				options: {
					swapLtrRtlInUrl: false
				},
				files: [
					{
						src: 'style.css',
						dest: 'style-rtl.css'
					},
					{
						src: 'editor-style.css',
						dest: 'editor-style-rtl.css'
					}
				]
			}
		},

		devUpdate: {
			main: {
				options: {
					updateType: 'force', //just report outdated packages
					reportUpdated: false, //don't report up-to-date packages
					semver: true, //stay within semver when updating
					packages: {
						devDependencies: true, //only check for devDependencies
						dependencies: false
					},
					packageJson: null, //use matchdep default findup to locate package.json
					reportOnlyPkgs: [] //use updateType action on all packages
				}
			}
		},

		jshint: {
			all: [ 'Gruntfile.js', 'assets/js/*.js', '!assets/js/*.min.js' ]
		},

		po2mo: {
			files: {
				src: 'languages/*.po',
				expand: true
			}
		},

		pot: {
			options:{
				text_domain: pkg.name, //Your text domain. Produces my-text-domain.pot
				dest: 'languages/', //directory to place the pot file
				keywords: [ //WordPress localisation functions
					'__:1',
					'_e:1',
					'_x:1,2c',
					'esc_html__:1',
					'esc_html_e:1',
					'esc_html_x:1,2c',
					'esc_attr__:1',
					'esc_attr_e:1',
					'esc_attr_x:1,2c',
					'_ex:1,2c',
					'_n:1,2',
					'_nx:1,2,4c',
					'_n_noop:1,2',
					'_nx_noop:1,2,3c'
				]
			},
			files:{
				src:  [ '**/*.php' ],
				expand: true
			}
		},

		replace: {
			pot: {
				src: 'languages/*.po*',
				overwrite: true,
				replacements: [
					{
						from: 'SOME DESCRIPTIVE TITLE.',
						to: pkg.title
					},
					{
						from: 'YEAR THE PACKAGE\'S COPYRIGHT HOLDER',
						to: new Date().getFullYear()
					},
					{
						from: 'FIRST AUTHOR <EMAIL@ADDRESS>, YEAR.',
						to: 'GoDaddy Operating Company, LLC.'
					},
					{
						from: 'charset=CHARSET',
						to: 'charset=UTF-8'
					}
				]
			}
		},

		sass: {
			dist: {
				files: {
					'style.css': '.dev/sass/style.scss',
					'editor-style.css': '.dev/sass/editor-style.scss'
				}
			},
			options: {
				sourceMap: false,
				includePaths: [
					require("bourbon").includePaths,
					require("bourbon-neat").includePaths,
					'./node_modules/normalize.css',
					'./node_modules/social-logos/icon-font'
				],
			}
		},

		'string-replace': {
			dist: {
				files: {
					'style.css': 'style.css',
				},
				options: {
					replacements: [{
						pattern: /social-logos.(eot|ttf|woff2)/ig,
						replacement: 'assets/fonts/social-logos.$1'
					}]
				}
			}
		},

		uglify: {
			options: {
				ASCIIOnly: true
			},
			core: {
				expand: true,
				cwd: 'assets/js',
				src: ['*.js', '!*.min.js'],
				dest: 'assets/js',
				ext: '.min.js'
			}
		},

		watch: {
			css: {
				files: '.dev/sass/**/*.scss',
				tasks: [ 'sass','autoprefixer','cssjanus', 'string-replace' ]
			},
			scripts: {
				files: [ 'Gruntfile.js', 'assets/js/*.js', '!assets/js/*.min.js' ],
				tasks: [ 'jshint', 'uglify' ],
				options: {
					interrupt: true
				}
			}
		}

	});


	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	grunt.registerTask( 'default', [ 'copy', 'sass', 'autoprefixer', 'cssjanus' ] );
	grunt.registerTask( 'lint', [ 'jshint' ] );
	grunt.registerTask( 'update-pot', [ 'pot', 'replace:pot' ] );

};
