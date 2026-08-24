/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    // Force generate all coffee & primary color variants
    {
      pattern: /(bg|text|border|from|via|to|ring)-(coffee|primary|brown)-(50|100|200|300|400|500|600|700|800|900)/,
    },
  ],
  theme: {
    extend: {
      colors: {
        coffee: {
          50: '#fdf2f2',
          100: '#fce4e4',
          200: '#facccc',
          300: '#f5a3a3',
          400: '#ed7171',
          500: '#e04848',
          600: '#c92a2a',
          700: '#a61e1e',
          800: '#891c1c',
          900: '#721b1b',
        },
        primary: {
          50: '#fef5ee',
          100: '#fde8d7',
          200: '#fbcdae',
          300: '#f7aa7a',
          400: '#f27c44',
          500: '#ee5a1f',
          600: '#df3f15',
          700: '#b92e14',
          800: '#932618',
          900: '#772316',
        },
        brown: {
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
