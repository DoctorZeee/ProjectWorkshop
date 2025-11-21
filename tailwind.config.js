/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Monochrome palette
        'black': '#000000',
        'white': '#ffffff',
      },
    },
  },
  plugins: [],
}
