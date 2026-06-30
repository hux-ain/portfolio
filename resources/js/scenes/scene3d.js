/**
 * Ultra-Simple 3D Scene with WebGL Fallback
 */

export class Scene3D {
    constructor(container) {
        console.log('[3D] Constructor start');
        this.container = container;

        // Check WebGL support FIRST
        if (!this.checkWebGL()) {
            console.log('[3D] WebGL not supported, hiding 3D canvas');
            this.hideCanvasCompletely();
            return;
        }

        console.log('[3D] WebGL supported, initializing...');

        try {
            // Import THREE dynamically
            if (typeof THREE === 'undefined') {
                console.error('[3D] THREE not loaded yet');
                this.hideCanvasCompletely();
                return;
            }

            this.init();
            this.animate();
            this.hideLoading();
            console.log('[3D] ✓ SUCCESS');
        } catch (error) {
            console.error('[3D] ✗ ERROR:', error);
            this.hideCanvasCompletely();
        }
    }

    checkWebGL() {
        try {
            const canvas = document.createElement('canvas');
            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            if (gl && gl.getParameter) {
                console.log('[3D] WebGL detected:', gl.getParameter(gl.RENDERER));
                return true;
            }
        } catch (e) {
            console.warn('[3D] WebGL check failed:', e);
        }
        return false;
    }

    init() {
        console.log('[3D] init() called');
        const width = this.container.clientWidth || window.innerWidth || 800;
        const height = this.container.clientHeight || window.innerHeight || 600;

        console.log('[3D] Dimensions:', width, 'x', height);

        // Scene
        this.scene = new THREE.Scene();

        // Camera
        this.camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        this.camera.position.z = 5;

        // Renderer
        this.renderer = new THREE.WebGLRenderer({
            antialias: true,
            alpha: true,
            powerPreference: 'high-performance'
        });
        this.renderer.setSize(width, height);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        this.container.appendChild(this.renderer.domElement);
        console.log('[3D] Renderer appended');

        // Show canvas (was hidden initially)
        this.container.classList.add('visible');

        // Simple cube
        console.log('[3D] Creating cube');
        const geometry = new THREE.BoxGeometry(2, 2, 2);
        const material = new THREE.MeshBasicMaterial({
            color: 0x3b82f6,
            wireframe: true,
            transparent: true,
            opacity: 0.8
        });
        this.cube = new THREE.Mesh(geometry, material);
        this.scene.add(this.cube);
        console.log('[3D] Cube added');

        // Hide loading
        this.hideLoading();
    }

    animate() {
        this.animationId = requestAnimationFrame(() => this.animate());

        if (this.cube) {
            this.cube.rotation.x += 0.01;
            this.cube.rotation.y += 0.02;
        }

        if (this.renderer && this.scene && this.camera) {
            this.renderer.render(this.scene, this.camera);
        }
    }

    hideLoading() {
        console.log('[3D] hideLoading() called');
        try {
            const loadingEl = this.container.querySelector('#3d-loading');
            if (loadingEl) {
                console.log('[3D] Hiding loading element');
                loadingEl.style.transition = 'opacity 0.3s ease';
                loadingEl.style.opacity = '0';
                setTimeout(() => {
                    if (loadingEl.parentNode) {
                        loadingEl.remove();
                    }
                }, 300);
            }
        } catch (error) {
            console.warn('[3D] hideLoading error:', error);
        }
    }

    hideLoadingWithError() {
        this.hideLoading();
    }

    hideCanvasCompletely() {
        console.log('[3D] Hiding canvas completely (WebGL not supported)');
        // Remove 3D canvas from display
        this.container.style.display = 'none';

        // Remove loading indicator
        const loadingEl = this.container.querySelector('#3d-loading');
        if (loadingEl && loadingEl.parentNode) {
            loadingEl.remove();
        }

        console.log('[3D] Canvas hidden, content should be visible');
    }
}
