module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            options: {
                sourcemap: 'none'
            },
            dist: {
                files: {
                    'tna-forms.css': 'css/tna-forms.scss'
                }
            }
        },
        watch: {
            scripts: {
                files: 'js/*.js',
                tasks: ['concat', 'uglify']
            },
            css: {
                files: 'css/*.scss',
                tasks: ['sass']
            }
        },
        qunit: {
            all: ['js/tests/**/*.html']
        },
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                src: ['js/tna-validation.js', 'js/tna-call-plugin.js'],
                dest: 'js/compiled/tna-forms.js'
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            my_target: {
                files: {
                    'js/compiled/tna-forms.min.js': ['js/compiled/tna-forms.js']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-qunit');

    // Default task(s).
    grunt.registerTask('default', ['sass', 'concat', 'uglify', 'watch', 'qunit']);

};