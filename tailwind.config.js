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
          50: '#faf6f1',
          100: '#f2e9dc',
          200: '#e4d3b9',
          300: '#d1b38f',
          400: '#bc8f66',
          500: '#a8724a',
          600: '#8d5e3f',
          700: '#724a35',
          800: '#5d3e30',
          900: '#4d352a',
        },
        primary: {
          50: '#faf5f0',
          100: '#f4e8d9',
          200: '#e9d0b3',
          300: '#dab283',
          400: '#ca9258',
          500: '#b8763b',
          600: '#a56030',
          700: '#894d29',
          800: '#6f3f26',
          900: '#5c3522',
        },
      },
      fontFamily: {
        sans: ['Inter var', 'Inter', 'system-ui', 'sans-serif'],
        display: ['Inter var', 'Inter', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
        'soft-lg': '0 10px 40px -10px rgba(0, 0, 0, 0.1)',
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.5s ease-out',
        'scale-in': 'scaleIn 0.3s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        scaleIn: {
          '0%': { transform: 'scale(0.9)', opacity: '0' },
          '100%': { transform: 'scale(1)', opacity: '1' },
        },
      },
    },
  },
  plugins: [],
}
