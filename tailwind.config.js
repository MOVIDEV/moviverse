import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: '#cb0c9f',
                secondary: '#8392AB',
                info: '#17c1e8',
                success: '#82d616',
                warning: '#fbcf33',
                danger: '#ea0606',
                dark: '#344767',
                light: '#e9ecef',
            },

            boxShadow: {
                'soft-sm': '0 .25rem .375rem -.0625rem rgba(0,0,0,.12)',
                'soft-md': '0 4px 7px -1px rgba(0,0,0,.11)',
                'soft-xl': '0 20px 27px 0 rgba(0,0,0,.05)',
            },

            borderRadius: {
                xl: '1rem',
                '2xl': '1.5rem',
            },
        },
    },

    plugins: [forms],
};
