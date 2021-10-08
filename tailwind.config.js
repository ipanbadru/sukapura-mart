const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Arial', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                sky : colors.sky,
                cyan: colors.cyan,
                'blue-gray' : colors.blueGray,
                purple: colors.purple,
                emerald: colors.emerald,
                violet: colors.violet,
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
