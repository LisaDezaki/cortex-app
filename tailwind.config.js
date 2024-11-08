/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.svelte',
  ],
	darkMode: 'selector',
  theme: {
    extend: {
		fontFamily: {
			sans: ['Author', 'sans-serif']
		}
	},
  },
  plugins: [require("daisyui")],
}

