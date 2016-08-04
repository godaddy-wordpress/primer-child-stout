module.exports = function(grunt) {

	var pkg = grunt.file.readJSON( 'package.json' );

	grunt.initConfig({

		pkg: pkg,

		autoprefixer: {
			options: {
				// Task-specific options go here.
			},
			your_target: {
				src: '*.css'
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
			all: ['Gruntfile.js', 'assets/js/*.js', '!assets/js/*.min.js']
		},

		po2mo: {
			files: {
				src: 'languages/*.po',
				expand: true
			}
		},

		pot: {
			options:{
				omit_header: false,
				text_domain: pkg.name,
				encoding: 'UTF-8',
				dest: 'languages/',
				keywords: [
					'__',
					'_e',
					'__ngettext:1,2',
					'_n:1,2',
					'__ngettext_noop:1,2',
					'_n_noop:1,2',
					'_c',
					'_nc:4c,1,2',
					'_x:1,2c',
					'_nx:4c,1,2',
					'_nx_noop:4c,1,2',
					'_ex:1,2c',
					'esc_attr__',
					'esc_attr_e',
					'esc_attr_x:1,2c',
					'esc_html__',
					'esc_html_e',
					'esc_html_x:1,2c'
				],
				msgmerge: true
			},
			files:{
				src: [
					'*.php',
					'inc/**/*.php',
					'templates/**/*.php'
				],
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
						from: "YEAR THE PACKAGE'S COPYRIGHT HOLDER",
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
				tasks: ['sass','autoprefixer','cssjanus', 'string-replace']
			},
			scripts: {
				files: ['Gruntfile.js', 'assets/js/*.js', '!assets/js/*.min.js'],
				tasks: ['jshint', 'uglify'],
				options: {
					interrupt: true
				}
			},
		},

		browserSync: {
			dev: {
				bsFiles: {
					src: [
						"*.css",
						"**/*.php",
						"*.js"
					]
				},
				options: {
					proxy: "godaddy.dev", // enter your local WP URL here
					watchTask: true
				}
			}
		},

	});

	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	grunt.registerTask('default', ['copy', 'browserSync', 'watch']);
	grunt.registerTask('lint', ['jshint']);
	grunt.registerTask('update-pot', ['pot', 'replace:pot']);

};
