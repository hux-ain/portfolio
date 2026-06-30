/**
 * Simple 3D Scene - Fallback version
 * Minimal Three.js setup that definitely works
 */

import * as THREE from 'three';

export class Scene3DSimple {
    constructor(container) {
        this.container = container;
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.cube = null;
        this.animationId = null;

        console.log('Scene3DSimple: Starting initialization...');

        try {
            this.init();
            this.createScene();
            this.animate();
            this.hideLoading();
            console.log('Scene3DSimple: Initialized successfully');
        } catch (error) {
            console.error('Scene3DSimple: Failed to initialize:', error);
        }
    }

    init() {
        // Get container size
        const width = this.container.clientWidth || window.innerWidth || 800;
        const height = this.container.clientHeight || window.innerHeight || 600;

        console.log('Scene3DSimple: Container size:', width, 'x', height);

        // Create scene
        this.scene = new THREE.Scene();

        // Create camera
        this.camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        this.camera.position.z = 5;

        // Create renderer
        this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        this.renderer.setSize(width, height);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        this.container.appendChild(this.renderer.domElement);

        // Handle resize
        window.addEventListener('resize', () => this.onResize());
    }

    createScene() {
        // Create a simple rotating cube
        const geometry = new THREE.BoxGeometry(2, 2, 2);
        const material = new THREE.MeshBasicMaterial({
            color: 0x3b82f6,
            wireframe: true,
            transparent: true,
            opacity: 0.8
        });
        this.cube = new THREE.Mesh(geometry, material);
        this.scene.add(this.cube);

        // Add some particles
        const particleCount = 200;
        const particlesGeometry = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);

        for (let i = 0; i < particleCount * 3; i++) {
            positions[i] = (Math.random() - 0.5) * 15;
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));

        const particlesMaterial = new THREE.PointsMaterial({
            color: 0x8b5cf6,
            size: 0.05,
            transparent: true,
            opacity: 0.6
        });

        this.particles = new THREE.Points(particlesGeometry, particlesMaterial);
        this.scene.add(this.particles);
    }

    animate() {
        this.animationId = requestAnimationFrame(() => this.animate());

        if (this.cube) {
            this.cube.rotation.x += 0.01;
            this.cube.rotation.y += 0.015;
        }

        if (this.particles) {
            this.particles.rotation.y += 0.002;
        }

        this.renderer.render(this.scene, this.camera);
    }

    onResize() {
        const width = this.container.clientWidth || window.innerWidth;
        const height = this.container.clientHeight || window.innerHeight;

        this.camera.aspect = width / height;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(width, height);
    }

    hideLoading() {
        const loadingEl = this.container.querySelector('#3d-loading');
        if (loadingEl) {
            console.log('Scene3DSimple: Hiding loading indicator');
            loadingEl.style.transition = 'opacity 0.5s ease';
            loadingEl.style.opacity = '0';
            setTimeout(() => {
                if (loadingEl.parentNode) {
                    loadingEl.remove();
                }
            }, 500);
        } else {
            console.warn('Scene3DSimple: Loading element not found');
        }
    }

    destroy() {
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
        }
        if (this.renderer) {
            this.renderer.dispose();
            if (this.renderer.domElement && this.renderer.domElement.parentNode) {
                this.container.removeChild(this.renderer.domElement);
            }
        }
    }
}
