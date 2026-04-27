// @ts-check
const { defineConfig } = require('@playwright/test');

module.exports = defineConfig({
    testDir: './tests/visual',
    outputDir: './tests/visual/test-results',
    snapshotDir: './tests/visual/screenshots',
    snapshotPathTemplate: '{snapshotDir}/{testName}/{arg}{ext}',

    fullyParallel: true,
    retries: 0,
    workers: 1,

    use: {
        baseURL: 'http://localhost:8234',
        screenshot: 'only-on-failure',
    },

    expect: {
        toHaveScreenshot: {
            maxDiffPixelRatio: 0.01,
            animations: 'disabled',
        },
    },

    projects: [
        {
            name: 'chromium',
            use: {
                browserName: 'chromium',
                viewport: { width: 1280, height: 720 },
            },
        },
    ],

    webServer: {
        command: 'php -S localhost:8234 tests/visual/serve.php',
        port: 8234,
        reuseExistingServer: !process.env.CI,
        timeout: 10000,
    },
});
