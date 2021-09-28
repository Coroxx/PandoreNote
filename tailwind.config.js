module.exports = {
    purge: [
        "./app/**/*.php",
        "./resources/**/*.html",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.ts",
        "./resources/**/*.php",
        "./resources/**/*.vue"
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        fontFamily: {
            'default': ['Inter', 'Arial'],
        },
        extend: {},
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
