// postcss.config.js
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';
import tailwindcssPlugin from '@tailwindcss/postcss';

export default {
  plugins: [
    tailwindcssPlugin(tailwindcss),
    autoprefixer,
  ],
};