<?php

namespace Grafite\Html\Tags;

use Exception;
use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class WordSwitcher extends HtmlComponent
{
    public static $duration;
    public static $delay;
    public static $random;

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [];
    }

    public static function duration($value)
    {
        self::$duration = $value;

        return new static();
    }

    public static function delay($value)
    {
        self::$delay = $value;

        return new static();
    }

    public static function random($value)
    {
        self::$random = $value;

        return new static();
    }

    public static function js()
    {
        $id = self::$id;
        $items = json_encode(self::$items);
        $delay = self::$delay ?? 3000;
        $duration = self::$duration ?? 250;
        $random = self::$random ?? false;

        return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                const defaultOptions = {
                    switchDelay: 3000,
                    animationDuration: 0,
                    random: false,
                    className: 'html-word-switcher'
                };

                 function wordSwitcher(target, words, opts) {
                    if (words.length <= 1) {
                        return;
                    }

                    const animateWord = () => {
                        if (opts.random) {
                            const preRandom = curWord;

                            while (preRandom === curWord) {
                                curWord = parseInt(Math.random() * words.length);
                            }
                        } else {
                            curWord = (curWord + 1) % words.length;
                        }

                        const span = document.createElement('span');
                            span.innerHTML = words[curWord];
                            span.classList.add(opts.className);

                        if (opts.animationDuration !== 0) {
                            if (opts.animationDuration === null) {
                                span.addEventListener('transitionend', endAnimation(span));
                                span.addEventListener('animationend', endAnimation(span));
                            } else {
                                setTimeout(startAnimation(span, 'leave'), opts.switchDelay + opts.animationDuration);
                            }

                            startAnimation(span, 'enter')();
                        }

                        while (target.firstChild) { target.removeChild(target.firstChild); }
                        target.appendChild(span);

                        if (opts.animationDuration !== null) {
                            setTimeout(() => {
                                requestAnimationFrame(animateWord);
                            }, opts.switchDelay + opts.animationDuration * 2);
                        }
                    };

                    const startAnimation = (span, type) => () => {
                        span.classList.add(`\${opts.className}-\${type}`);
                        span.classList.add(`\${opts.className}-\${type}-active`);

                        requestAnimationFrame(() => {
                            if (type === 'enter') {
                                // Can't find a better way at the moment.
                                // Without waiting two frames the enter class doesn't have a chance,
                                // which stuffs up opacity transitions (and probably others).
                                requestAnimationFrame(animationEntered(span));
                            } else {
                                animationEntered(span)();
                            }
                        });

                        if (opts.animationDuration !== null) {
                            setTimeout(endAnimation(span), opts.animationDuration);
                        }
                    };

                    const animationEntered = (span) => () => {
                        if (span.classList.contains(opts.className + '-enter-active')) {
                            span.classList.remove(opts.className + '-enter');
                            span.classList.add(opts.className + '-enter-to');
                        } else {
                            span.classList.remove(opts.className + '-leave');
                            span.classList.add(opts.className + '-leave-to');
                        }
                    };

                    const endAnimation = (span) => () => {
                        if (span.classList.contains(opts.className + '-enter-active')) {
                            span.classList.remove(opts.className + '-enter-active');
                            span.classList.remove(opts.className + '-enter-to');

                        setTimeout(startAnimation(span, 'leave'), opts.switchDelay);
                        } else {
                            span.classList.remove(opts.className + '-leave-active');
                            span.classList.remove(opts.className + '-leave-to');

                            animateWord();
                        }
                    };

                    opts = Object.assign(Object.assign({}, defaultOptions), opts || {});
                    let curWord = -1;

                    requestAnimationFrame(animateWord);
                }

                wordSwitcher(document.getElementById('{$id}'), {$items}, {
                    switchDelay: "{$delay}",
                    animationDuration: "{$duration}",
                    random: "{$random}",
                    className: 'html-word-switcher'
                });
            });
        JS;
    }

    public static function styles()
    {
        return <<<CSS
            .html-word-switcher-enter-active, .html-word-switcher-leave-active {
                transition: opacity 1s;
            }

            .html-word-switcher-enter, .html-word-switcher-leave-to {
                opacity: 0;
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_' . Str::uuid();

        $id = self::$id;
        $text = self::$text;
        $css = self::$css;

        self::$html = <<<HTML
            <span id="{$id}" class="{$css}">
                {$text}
            </span>
        HTML;
    }
}
