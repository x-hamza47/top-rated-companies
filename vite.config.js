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
                "resources/css/editor.css",
                "resources/css/dashboard-css/app.css",
                "resources/css/dashboard-css/form.css",

                // Info: JS Files
                "resources/js/app.js",
                "resources/js/home.js",
                "resources/js/faqs.js",
                "resources/js/listicle.js",
                "resources/js/dashboard/summernote.js",
                "resources/js/dashboard/script.js",
                "resources/js/dashboard/admin-chart.js",
                "resources/js/dashboard/company-chart.js",
                "resources/js/dashboard/company-details.js",
                "resources/js/dashboard/rangeSlider.js",
                // "resources/js/dashboard/editor/editor-tools.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
 
});
