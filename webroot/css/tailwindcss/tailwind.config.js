module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {
        lineClamp: ['hover'],
        backgroundColor: ['active'],
        fontWeight: ['group-hover'],
        position: ['hover'],
        textColor: ['active']
    },
  },
  plugins: [
      require('@tailwindcss/line-clamp'),
  ],
}
