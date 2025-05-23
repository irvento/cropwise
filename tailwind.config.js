import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    ssafelist: [
    // Yellow
    'bg-yellow-100', 'bg-yellow-200', 'bg-yellow-300',
    'bg-yellow-400', 'bg-yellow-500', 'bg-yellow-600',
    'bg-yellow-700', 'bg-yellow-800', 'bg-yellow-900',

    // Orange
    'bg-orange-100', 'bg-orange-200', 'bg-orange-300',
    'bg-orange-400', 'bg-orange-500', 'bg-orange-600',
    'bg-orange-700', 'bg-orange-800', 'bg-orange-900',

    // Amber
    'bg-amber-100', 'bg-amber-200', 'bg-amber-300',
    'bg-amber-400', 'bg-amber-500', 'bg-amber-600',
    'bg-amber-700', 'bg-amber-800', 'bg-amber-900',

    // Lime
    'bg-lime-100', 'bg-lime-200', 'bg-lime-300',
    'bg-lime-400', 'bg-lime-500', 'bg-lime-600',
    'bg-lime-700', 'bg-lime-800', 'bg-lime-900',

    // Green
    'bg-green-100', 'bg-green-200', 'bg-green-300',
    'bg-green-400', 'bg-green-500', 'bg-green-600',
    'bg-green-700', 'bg-green-800', 'bg-green-900',

    // Red
    'bg-red-100', 'bg-red-200', 'bg-red-300',
    'bg-red-400', 'bg-red-500', 'bg-red-600',
    'bg-red-700', 'bg-red-800', 'bg-red-900',
],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms, typography],
};

