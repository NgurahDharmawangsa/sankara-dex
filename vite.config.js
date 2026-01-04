import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/apps/auth/forgot-password.js',
                'resources/js/apps/category/category.js',
                'resources/js/apps/subcategory/subcategory.js',
                'resources/js/apps/users/user.js',
                'resources/js/apps/users/profile.js',
                'resources/js/apps/report/job-report.js',
                'resources/js/apps/job/job.js',
                'resources/js/apps/dashboard/dashboard.js',
                'resources/js/apps/job-history/job-history.js',
		        'resources/js/apps/auth/login.js',
		        'resources/js/apps/job/user-job.js',
            ],
            refresh: true,
        }),
    ],
});
