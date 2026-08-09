<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class Confetti extends HtmlComponent
{
    public static $content;

    public static $trigger;

    public static $particleCount;

    public static $spread;

    public static $colors;

    public static $duration;

    public static function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public static function trigger($value)
    {
        self::$trigger = $value;

        return new static;
    }

    public static function particleCount($value)
    {
        self::$particleCount = $value;

        return new static;
    }

    public static function spread($value)
    {
        self::$spread = $value;

        return new static;
    }

    public static function colors($value)
    {
        self::$colors = $value;

        return new static;
    }

    public static function duration($value)
    {
        self::$duration = $value;

        return new static;
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [];
    }

    public static function styles()
    {
        return <<<'CSS'
        .html-confetti-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }
        CSS;
    }

    public static function js()
    {
        $id = self::$id;

        $options = [];
        $options['targetId'] = $id;
        $options['trigger'] = self::$trigger ?? 'load';
        $options['particleCount'] = (int) (self::$particleCount ?? 150);
        $options['spread'] = (int) (self::$spread ?? 70);
        $options['colors'] = self::$colors ?? ['#26ccff', '#a25afd', '#ff5e7e', '#88ff5a', '#fcff42', '#ffa62d', '#ff36ff'];
        $options['duration'] = (int) (self::$duration ?? 3000);

        $jsonOptions = json_encode($options);

        return <<<JS
            const HtmlConfetti_{$id} = function (options) {
                const colors = options.colors;
                const particleCount = options.particleCount;
                const spread = options.spread;
                const duration = options.duration;

                function fire() {
                    const canvas = document.createElement('canvas');
                    canvas.className = 'html-confetti-canvas';
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                    document.body.appendChild(canvas);

                    const ctx = canvas.getContext('2d');
                    const particles = [];
                    const originX = canvas.width / 2;
                    const originY = canvas.height / 3;

                    for (let i = 0; i < particleCount; i++) {
                        const angle = (Math.random() * spread - spread / 2) * (Math.PI / 180) - Math.PI / 2;
                        const velocity = 6 + Math.random() * 6;
                        particles.push({
                            x: originX,
                            y: originY,
                            vx: Math.cos(angle) * velocity,
                            vy: Math.sin(angle) * velocity,
                            size: 5 + Math.random() * 5,
                            color: colors[Math.floor(Math.random() * colors.length)],
                            rotation: Math.random() * 360,
                            rotationSpeed: (Math.random() - 0.5) * 20,
                            opacity: 1,
                        });
                    }

                    const start = performance.now();

                    function frame(now) {
                        const elapsed = now - start;
                        ctx.clearRect(0, 0, canvas.width, canvas.height);

                        particles.forEach((p) => {
                            p.vy += 0.18;
                            p.x += p.vx;
                            p.y += p.vy;
                            p.rotation += p.rotationSpeed;
                            p.opacity = Math.max(0, 1 - elapsed / duration);

                            ctx.save();
                            ctx.globalAlpha = p.opacity;
                            ctx.translate(p.x, p.y);
                            ctx.rotate(p.rotation * Math.PI / 180);
                            ctx.fillStyle = p.color;
                            ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size / 2);
                            ctx.restore();
                        });

                        if (elapsed < duration) {
                            requestAnimationFrame(frame);
                        } else {
                            canvas.remove();
                        }
                    }

                    requestAnimationFrame(frame);
                }

                if (options.trigger === 'click') {
                    const el = document.getElementById(options.targetId);
                    if (el) {
                        el.addEventListener('click', fire);
                    }
                } else {
                    fire();
                }
            };

            document.addEventListener('DOMContentLoaded', function () {
                HtmlConfetti_{$id}({$jsonOptions});
            });

            if (document.readyState !== 'loading') {
                HtmlConfetti_{$id}({$jsonOptions});
            }
        JS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.str_replace('-', '_', Str::uuid());

        $id = self::$id;
        $css = self::$css ?? '';
        $content = self::$content ?? '';

        self::$html = <<<HTML
            <div id="{$id}" class="html-confetti {$css}">{$content}</div>
        HTML;
    }
}
