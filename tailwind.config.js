module.exports = {
  purge: [],
  theme: {
    extend: {
      width: {
        '96': '24rem'
      },
      maxHeight: {
        '0': '0',
        '1/4': '25vh',
        '1/3': '33vh',
        '1/2': '50vh',
        '2/3': '66vh',
        '3/4': '75vh',
        'full': '100vh',
      }
    },
    spinner: (theme) => ({
      default: {
        color: '#dae1e7',
        size: '1em',
        border: '2px',
        speed: '500ms',
      },
    }),

  },
  variants: {},
  plugins: [
    require('tailwindcss-spinner')(),
  ],
}
