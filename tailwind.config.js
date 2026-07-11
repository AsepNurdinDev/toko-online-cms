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
            colors: {
                rust: { 600: '#b45309' },   // sesuaikan hex-nya
                brass: { 400: '#c9a76a', 500: '#b08d57' },
                cream: { 50: '#faf6ee', 100: '#f3ead9' },
                ink: { 700: '#3a2f28', 900: '#1c1712' },
        },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
