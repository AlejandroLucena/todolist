const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  purge: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    './vendor/laravel/jetstream/**/*.blade.php',
    "./resources/views/**/*.blade.php",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ["Nunito", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          DEFAULT: "#308446",
          50: "#B5E4C2",
          100: "#A3DDB2",
          200: "#7DD093",
          300: "#58C274",
          400: "#3EA95A",
          500: "#308446",
          600: "#225F32",
          700: "#15391E",
          800: "#07140B",
          900: "#000000",
        },
        second: {
          DEFAULT: "#063971",
          50: "#66ABF7",
          100: "#4D9EF6",
          200: "#1D83F3",
          300: "#0B6AD2",
          400: "#0951A1",
          500: "#063971",
          600: "#032141",
          700: "#010810",
          800: "#000000",
          900: "#000000",
        },
      },
    },
  },
  variants: {
    extend: {
      backgroundColor: ["active"],
    },
  },
  purge: {
    content: [
      "./app/**/*.php",
      "./resources/**/*.html",
      "./resources/**/*.js",
      "./resources/**/*.jsx",
      "./resources/**/*.ts",
      "./resources/**/*.tsx",
      "./resources/**/*.php",
      "./resources/**/*.vue",
      "./resources/**/*.twig",
    ],
    options: {
      defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
      whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
    require("tailwindcss-inset")({
      variants: ["responsive"], // default: []
      insets: {
        "1/2": "50%",
        full: "100%",
      },
    }),
  ],
};
