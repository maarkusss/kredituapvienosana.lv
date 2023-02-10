const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    content: ["./resources/**/*.blade.php"],
    darkMode: "media",
    theme: {
        extend: {
            backgroundImage: {
                calculatorjpg: "url('/images/calculator-pencil.jpg')",
                darktintjpg: "url('/images/dark_tint.png')",
            },
            colors: {
                gray: colors.neutral,
                "gray-slate": colors.slate,
                primary: {
                    normal: "#343a40",
                    text: "#6c757d",
                    dark: "#bbb",
                    button: "#146ef5",
                },
                secondary: {
                    normal: "#e89980",
                    dark: "#f9e5df",
                },
                background: {
                    normal: "#f0f0f0",
                },
            },
            screens: {
                xs: "480px",
            },
            boxShadow: {
                bootstrap: "0 1px 6px rgb(32 33 36 / 28%);",
            },
            fontFamily: {
                helvetica: [
                    "Helvetica Neue",
                    "Helvetica",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("@tailwindcss/line-clamp"),
    ],
};
