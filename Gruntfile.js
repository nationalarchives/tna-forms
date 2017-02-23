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
                    'css/tna-forms.css': 'css/tna-forms.scss'
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
                src: ['js/tna-validation.js', 'js/forms/inc/methods.js', 'js/forms/form-british-citizenship.js', 'js/forms/form-default.js', 'js/forms/form-records-research-enquiry.js','js/forms/form-your-views.js','js/forms/form-general.js','js/forms/form-public-sector.js','js/forms/form-iacs-training.js', 'js/forms/form-apply-to-film.js', 'js/forms/form-pronom.js', 'js/forms/form-document-condition-feedback.js' , 'js/forms/form-foi-corporate.js' , 'js/tna-call-plugin.js','js/jquery.history.js' ],
                dest: 'js/compiled/tna-forms-compiled.js'
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            my_target: {
                files: {
                    'js/compiled/tna-forms-compiled.min.js': ['js/compiled/tna-forms-compiled.js']
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