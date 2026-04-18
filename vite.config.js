import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/frontend.css",
                "resources/css/home.css",
                "resources/css/auth.css",
                "resources/css/listicle.css",
                "resources/css/dashboard-css/app.css",
                "resources/css/dashboard-css/form.css",

                // Info: JS Files
                "resources/js/app.js",
                "resources/js/home.js",
                "resources/js/faqs.js",
                "resources/js/listicle.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // server: {
    //     // host: "192.168.1.109", // your local IP true if all interfaces
    //     // port: 5173, // default Vite port
    // },
});
