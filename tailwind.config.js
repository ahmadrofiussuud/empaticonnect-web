import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#3B82F6', // Soft Blue
                'accent': '#F97316',  // Warm Orange
                'primary-dark': '#2563EB',
                'accent-dark': '#EA580C',
                'primary-light': '#60A5FA',
                'accent-light': '#FB923C',
            },
        },
    },

    plugins: [forms],
};
