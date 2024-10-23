import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "public/assets/scss/app.scss",
                "public/assets/scss/themes/dark/app-dark.scss",
                "public/assets/scss/pages/auth.scss",
                "public/assets/static/js/initTheme.js",
                "public/assets/static/js/components/dark.js",
                "public/assets/js/app.js",
                "resources/js/perfect-scrollbar.js",
                "resources/js/components/sweetalert2.js",
                "resources/js/views/dashboard.js",
                "resources/js/views/laporan.js",
                "resources/js/components/flatpickr.js",
                "resources/js/components/datatables/detail-alumni-bekerja.js",
                "resources/js/components/filepond/excel.js",
                "resources/js/components/datatables/data-alumni.js",
                "resources/js/wilayah.js",
                "resources/js/components/filepond/images.js",
                "resources/js/bidang-usaha.js",
                "resources/js/components/datatables/data-perusahaan.js",
                "resources/js/components/datatables/akun-pengguna.js",
                "resources/js/components/datatables/aktivitas-pengguna.js",
                "resources/js/views/pendidikan-non-formal.js",
                "resources/js/components/datatables/ajuan-lowongan.js",
                "resources/js/components/datatables/lamaran-terbaru.js",
                "resources/js/components/datatables/lamaran-arsip.js",
                "resources/js/components/filepond/pdf.js",
                "resources/js/components/datatables/lamaran-saya.js",
                "resources/js/components/filepond/images.js",
                "resources/js/components/datatables/lowongan.js",
                "resources/js/components/datatables/lacak-alumni.js",
                "resources/js/loader.js",
            ],
            refresh: true,
        }),
    ],
});
