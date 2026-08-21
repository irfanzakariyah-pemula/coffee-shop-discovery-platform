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
        coffee: {
          50: '#fdf8f3',
          100: '#f7e9d7',
          200: '#eed2af',
          300: '#e3b67e',
          400: '#d89654',
          500: '#c97d3c',
          600: '#b56430',
          700: '#964d2a',
          800: '#7a3f27',
          900: '#643522',
        },
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
