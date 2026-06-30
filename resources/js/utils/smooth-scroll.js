/**
 * Smooth Scroll Manager - 2026 Portfolio
 * Inertial scrolling with Lenis-like feel
 */

export class SmoothScroll {
    constructor(options = {}) {
        this.isEnabled = options.enabled !== false;
        this.lerp = options.lerp || 0.1;
        this.current = 0;
        this.target = 0;
        this.ease = 0.08;

        if (this.isEnabled && typeof window !== 'undefined') {
            this.init();
        }
    }

    init() {
        // Add smooth scroll class to html
        document.documentElement.classList.add('smooth-scroll');

        // Set initial position
        this.current = window.pageYOffset;
        this.target = this.current;

        // Start animation loop
        this.animate();

        // Handle scroll events
        window.addEventListener('scroll', () => {
            this.target = window.pageYOffset;
        }, { passive: true });

        // Handle resize
        window.addEventListener('resize', () => this.onResize());
    }

    animate() {
        if (!this.isEnabled) return;

        // Smooth lerp interpolation
        this.current += (this.target - this.current) * this.lerp;

        // Apply transform to main content
        const main = document.querySelector('main');
        if (main) {
            main.style.transform = `translate3d(0, ${-this.current}px, 0)`;
        }

        // Dispatch custom scroll event with easing
        const wheelEvent = new CustomEvent('smoothscroll', {
            detail: {
                current: this.current,
                target: this.target,
                progress: this.current / (document.documentElement.scrollHeight - window.innerHeight)
            }
        });
        window.dispatchEvent(wheelEvent);

        requestAnimationFrame(() => this.animate());
    }

    onResize() {
        // Recalculate on resize
        this.current = window.pageYOffset;
        this.target = this.current;
    }

    destroy() {
        this.isEnabled = false;
        document.documentElement.classList.remove('smooth-scroll');

        const main = document.querySelector('main');
        if (main) {
            main.style.transform = '';
        }
    }
}

// Polyfill for CSS custom properties in older browsers
export function supportsCssVariables() {
    return typeof CSS !== 'undefined' && CSS.supports && CSS.supports('--test', '0');
}
