// @ts-check
const { test, expect } = require('@playwright/test');

/**
 * Static components that render immediately without external JS dependencies.
 * These are the most reliable for pixel-perfect screenshot comparison.
 */
const staticComponents = [
    'accordion',
    'admonition',
    'alert',
    'breadcrumbs',
    'card',
    'divider',
    'dropdown-button',
    'dropdown-button-action',
    'dropdown-button-group',
    'feed',
    'list-group',
    'modal',
    'nav',
    'nav-bar',
    'offcanvas',
    'progress',
    'spinner',
    'status',
    'table',
];

for (const component of staticComponents) {
    test(`static: ${component}`, async ({ page }) => {
        await page.goto(`/${component}`);
        await page.waitForLoadState('domcontentloaded');

        const container = page.locator('.visual-test-container');
        await expect(container).toBeVisible();
        await expect(container).toHaveScreenshot(`${component}.png`);
    });
}

/**
 * Announcement uses position:fixed so it renders outside the container.
 * Screenshot the fixed-position element directly.
 */
test('static: announcement', async ({ page }) => {
    await page.goto('/announcement');
    await page.waitForLoadState('domcontentloaded');

    const announcement = page.locator('.html-announcement');
    await expect(announcement).toBeVisible();
    await expect(announcement).toHaveScreenshot('announcement.png');
});

/**
 * Components that rely on JS initialization but render quickly.
 * We wait a bit longer for scripts to execute.
 */
const jsComponents = [
    'countdown',
    'image-compare',
    'marquee',
    'popover',
    'rating',
    'word-switcher',
];

for (const component of jsComponents) {
    test(`js-init: ${component}`, async ({ page }) => {
        await page.goto(`/${component}`);
        await page.waitForLoadState('networkidle');
        // Allow JS to fully initialize
        await page.waitForTimeout(500);

        const container = page.locator('.visual-test-container');
        await expect(container).toBeVisible();
        await expect(container).toHaveScreenshot(`${component}.png`);
    });
}

/**
 * Components that load images from external URLs.
 * We wait for network idle to ensure images have loaded.
 */
const imageComponents = [
    'avatar',
    'carousel',
    'image',
    'lightbox',
];

for (const component of imageComponents) {
    test(`image: ${component}`, async ({ page }) => {
        await page.goto(`/${component}`);
        await page.waitForLoadState('networkidle');
        // Allow images to fully render
        await page.waitForTimeout(1000);

        const container = page.locator('.visual-test-container');
        await expect(container).toBeVisible();
        // Remote images (e.g. Gravatar) can have slight compression differences
        await expect(container).toHaveScreenshot(`${component}.png`, {
            maxDiffPixelRatio: 0.05,
        });
    });
}

/**
 * Components that load external JS libraries (CDN).
 * These need longer timeouts for script loading and initialization.
 */
test('cdn: calendar', async ({ page }) => {
    await page.goto('/calendar');
    await page.waitForLoadState('networkidle');
    await page.waitForTimeout(1000);

    const container = page.locator('.visual-test-container');
    await expect(container).toBeVisible();
    // Calendar dates change daily — use a higher tolerance
    await expect(container).toHaveScreenshot('calendar.png', {
        maxDiffPixelRatio: 0.05,
    });
});

test('cdn: map', async ({ page }) => {
    await page.goto('/map');
    await page.waitForLoadState('networkidle');
    // Map tiles load asynchronously
    await page.waitForTimeout(3000);

    const container = page.locator('.visual-test-container');
    await expect(container).toBeVisible();
    // Map tiles can vary slightly
    await expect(container).toHaveScreenshot('map.png', {
        maxDiffPixelRatio: 0.05,
    });
});

test('cdn: parallax', async ({ page }) => {
    await page.goto('/parallax');
    await page.waitForLoadState('networkidle');
    await page.waitForTimeout(1000);

    const container = page.locator('.visual-test-container');
    await expect(container).toBeVisible();
    await expect(container).toHaveScreenshot('parallax.png', {
        maxDiffPixelRatio: 0.02,
    });
});

test('cdn: text', async ({ page }) => {
    await page.goto('/text');
    await page.waitForLoadState('networkidle');
    await page.waitForTimeout(1000);

    const container = page.locator('.visual-test-container');
    await expect(container).toBeVisible();
    await expect(container).toHaveScreenshot('text.png', {
        maxDiffPixelRatio: 0.02,
    });
});

test('cdn: tilt', async ({ page }) => {
    await page.goto('/tilt');
    await page.waitForLoadState('networkidle');
    await page.waitForTimeout(500);

    const container = page.locator('.visual-test-container');
    await expect(container).toBeVisible();
    await expect(container).toHaveScreenshot('tilt.png');
});

test('cdn: video', async ({ page }) => {
    await page.goto('/video');
    await page.waitForLoadState('networkidle');
    await page.waitForTimeout(2000);

    const container = page.locator('.visual-test-container');
    await expect(container).toBeVisible();
    // Video player UI can vary slightly
    await expect(container).toHaveScreenshot('video.png', {
        maxDiffPixelRatio: 0.03,
    });
});

/**
 * GithubGraph renders entirely via JS using localStorage.
 * The grid dates shift daily so we use a higher tolerance.
 */
test('inline-js: github-graph', async ({ page }) => {
    await page.goto('/github-graph');
    await page.waitForLoadState('domcontentloaded');

    // Wait for JS to build the graph and set display:block
    const graph = page.locator('.github-contrib');
    await expect(graph).toBeVisible({ timeout: 10000 });

    // Date-dependent rendering — higher tolerance
    await expect(graph).toHaveScreenshot('github-graph.png', {
        maxDiffPixelRatio: 0.05,
    });
});

/**
 * Hero uses WebGL via Vanta.js — GPU-dependent rendering.
 * Higher tolerance needed for cross-machine consistency.
 */
test('webgl: hero', async ({ page }) => {
    await page.goto('/hero');
    await page.waitForLoadState('networkidle');
    // Allow Vanta.js WebGL to fully render
    await page.waitForTimeout(3000);

    const container = page.locator('.visual-test-container');
    await expect(container).toBeVisible();
    // WebGL rendering varies by GPU — generous threshold
    await expect(container).toHaveScreenshot('hero.png', {
        maxDiffPixelRatio: 0.10,
    });
});
