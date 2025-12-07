/** @type {import('tailwindcss').Config} */
export default {
  content: ["./templates/**/*.{twig,html,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Libre Franklin", "sans-serif"],
        serif: ["Libre Franklin", "sans-serif"],
        primary: ["Libre Franklin", "sans-serif"],
        secondary: ["Libre Franklin", "sans-serif"],
      },
      colors: {
        primary: "#00235D",
        secondary: "#E5E515",
        vividBlue: "#0072BC",
        mutedBlue: "#0121369E",
        lightSkyBlue: "#8ED8F8",
        navyShadow: "#012136B2",
        deepNavyShadow: "#012136",
        lightSkyBlueHover: "#0072BCE5",
        lightBlue: "#D8F4FF",
        mpaDarkBlue: "#242449",
        mpaLightBlue: "#00A7EA",
        blue: {
          100: "#F4FCFF"
        }
      },
      // custom breakpoints
      screens: {
        "md2": "970px",
      },
      container: {
        center: true,
        padding: "1.25rem",
        screens: {
          DEFAULT: "1361px",
        },
      },
      boxShadow: {
        'section': '0px 0px 64px 0px #0000001A',
      },
    },
  },
  plugins: [],
};
