// /** @type {import('tailwindcss').Config} */

const defaultTheme = require ('tailwindcss/defaultTheme')

module.exports = {
  darkMode: 'class',
  content: ["**/*.twig", "../../../modules/custom/**/*.twig"],
  theme: {

    borderRadius: {
      41: '41px',
      100: '100px',
      'none': '0',
      'sm': '4px',
      'md': '9px',
      'lg': '12px',
      'full': '9999px',
      'xl': '24px',
    },
    rotate: {
      '-35': '-35deg',
      '12': '12deg',
    },
    screens: {
      'xs': '375px',
      ...defaultTheme.screens,

      'sm': '768px',
      // => @media (min-width: 640px) { ... }

      'md': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1440px',
      // => @media (min-width: 1440px) { ... }
    },
    extend: {
      fontFamily: {
        "kumbh-sans": ['"Kumbh Sans"', "sans-serif"],
        body: '"Kumbh Sans"',
      },
      colors: {
        bluegray: "#6E8098",
        lighttext: "#9DAEC2",
        lightestblue: "#939BF4",
        lightgray: "#F2F2F2",
        darkgray1: "#19202D",
        darkblue: "#19202D",
        darkgray: "#121721",
        bluemane: '#5964E0',
        lightgrey: '#e5e7eb',
        midnight: '#4b5563',
      },
      spacing: {
        150: '150px',
        730: '730px',
        128: '515px',
        124: '457px',
        41: '41.48px',
        343: '343.49px',
        247: '247px',
        37: '37px',
        314: '314',
        960: '960px',
        26: '6.5rem',
        20: '5rem',
        140: '8.75rem',
        24: '1.5rem',
        90: '21.8rem',
        340: '350px',
        228: '228px',
        50: '50px',
      },
      opacity: {
        10: '.1',
      },
    },
  },
  plugins: [],
};
