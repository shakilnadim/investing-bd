const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#FCAC10',
                },
                grayOverlay: {
                    '900': {
                        DEFAULT: 'rgba(17,24,39,0.5)',
                        lighter: 'rgba(17,24,39,0.3)'
                    },
                    '300': 'rgba(203,213,225,0)'
                }
            },
            height: {
                '92': '23rem',
                '43': '11.25rem',
                '34': '8.75rem',
            },
            maxWidth: {
                'primary' : '1280px',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
