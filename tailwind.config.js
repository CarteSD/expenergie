/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/**/*.{js,html,php,twig}"],
    theme: {
        fontFamily: {
            'serif': ["'Urbanist'", "ui-serif", "Georgia", "Cambria", "Times New Roman", "Times", "serif"],
            'sans': ["'Barlow Condensed'", "ui-sans-serif", "system-ui", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"]
        },
        extend: {
            colors: {
                'platinum': {
                    'base': '#E3E3E3',
                    '1': '#C7C7C7',
                    '2': '#ABABAB',
                    '3': '#8F8F8F',
                    '4': '#737373',
                },
                'charcoal': {
                    'base': '#18242D',
                    '1': '#2C4251',
                    '2': '#3A586B',
                    '3': '#496D86',
                    '4': '#5783A0',
                },
                'orange': {
                    '100': '#FFDEA3',
                    '200': '#FFD07A',
                    '300': '#FFC152',
                    '400': '#FFB329',
                    'base': '#FFA400',
                    '600': '#C78000',
                    '700': '#8F5C00',
                    '800': '#573800',
                    '900': '#1F1400',
                }
            }
        }
    },
}

