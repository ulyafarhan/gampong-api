/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        serif: ['Merriweather', 'serif'],
      },
      colors: {
        // Sesuai brief: Hijau Tua, Krem, Emas
        primary: {
          light: '#10B981', // emerald-500
          DEFAULT: '#047857', // emerald-700
          dark: '#065F46', // emerald-800
        },
        secondary: {
          light: '#F9FAFB', // gray-50
          DEFAULT: '#F3F4F6', // gray-100
          dark: '#E5E7EB', // gray-200
        },
        accent: {
          light: '#FCD34D', // amber-300
          DEFAULT: '#FBBF24', // amber-400
          dark: '#F59E0B', // amber-500
        },
        'dark-text': '#374151', // gray-700
      }
    },
  },
  plugins: [],
}
