<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skills
        $skills = [
            // Backend
            ['name' => 'Laravel', 'category' => 'backend', 'icon_class' => 'fa-brands fa-laravel', 'proficiency_level' => 90, 'order_number' => 1, 'is_featured' => true],
            ['name' => 'PHP', 'category' => 'backend', 'icon_class' => 'fa-brands fa-php', 'proficiency_level' => 85, 'order_number' => 2, 'is_featured' => true],
            ['name' => 'MySQL', 'category' => 'backend', 'icon_class' => 'fa-solid fa-database', 'proficiency_level' => 85, 'order_number' => 3, 'is_featured' => true],

            // Frontend
            ['name' => 'HTML', 'category' => 'frontend', 'icon_class' => 'fa-brands fa-html5', 'proficiency_level' => 90, 'order_number' => 4, 'is_featured' => true],
            ['name' => 'CSS', 'category' => 'frontend', 'icon_class' => 'fa-brands fa-css3-alt', 'proficiency_level' => 85, 'order_number' => 5, 'is_featured' => true],
            ['name' => 'JavaScript', 'category' => 'frontend', 'icon_class' => 'fa-brands fa-js-square', 'proficiency_level' => 80, 'order_number' => 6, 'is_featured' => true],

            // DevOps & Tools
            ['name' => 'Linux (Ubuntu)', 'category' => 'devops', 'icon_class' => 'fa-brands fa-linux', 'proficiency_level' => 75, 'order_number' => 7, 'is_featured' => true],
            ['name' => 'Git/GitHub', 'category' => 'tools', 'icon_class' => 'fa-brands fa-github', 'proficiency_level' => 85, 'order_number' => 8, 'is_featured' => true],
            ['name' => 'Nginx/Apache', 'category' => 'devops', 'icon_class' => 'fa-solid fa-server', 'proficiency_level' => 70, 'order_number' => 9, 'is_featured' => false],
        ];

        foreach ($skills as $skill) {
            \App\Models\Skill::create($skill);
        }

        // Projects
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'description' => 'Full-featured online shopping platform with payment integration, user authentication, admin dashboard, and real-time inventory management.',
                'image_path' => 'projects/ecommerce.jpg',
                'tech_stack' => ['Laravel', 'MySQL', 'Stripe API', 'Tailwind CSS', 'JavaScript'],
                'github_link' => 'https://github.com/Hux_Ain/ecommerce-platform',
                'live_link' => 'https://hussain-dev.com/ecommerce',
                'order_number' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'REST API for Mobile App',
                'description' => 'Scalable RESTful API serving millions of requests monthly. Features JWT authentication, rate limiting, caching, and comprehensive documentation.',
                'image_path' => 'projects/api.jpg',
                'tech_stack' => ['Laravel', 'MySQL', 'Redis', 'JWT', 'Swagger'],
                'github_link' => 'https://github.com/Hux_Ain/api-server',
                'live_link' => 'https://api.hussain-dev.com',
                'order_number' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Learning Management System',
                'description' => 'Custom LMS for educational institutions with course management, student tracking, online quizzes, and video streaming capabilities.',
                'image_path' => 'projects/lms.jpg',
                'tech_stack' => ['Laravel', 'MySQL', 'Vimeo API', 'Livewire', 'Bootstrap'],
                'github_link' => 'https://github.com/Hux_Ain/lms-project',
                'live_link' => 'https://lms.hussain-dev.com',
                'order_number' => 3,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            \App\Models\Project::create($project);
        }

        // Experiences
        $experiences = [
            [
                'title' => 'Web Developer',
                'company' => 'Gerry\'s IT',
                'location' => 'Karachi, Pakistan',
                'start_date' => '2024-01-01',
                'end_date' => null,
                'description' => 'Developing company portals, optimizing database queries, and implementing secure authentication systems. Working with Laravel, MySQL, and Linux servers.',
                'is_current' => true,
                'order_number' => 1,
            ],
            [
                'title' => 'Freelance Developer',
                'company' => 'Self-Employed',
                'location' => 'Remote',
                'start_date' => '2023-06-01',
                'end_date' => '2023-12-31',
                'description' => 'Built custom web applications for small businesses. Technologies: PHP, Laravel, MySQL, HTML/CSS/JavaScript.',
                'is_current' => false,
                'order_number' => 2,
            ],
            [
                'title' => 'BS Software Engineering',
                'company' => 'Iqra University',
                'location' => 'Karachi, Pakistan',
                'start_date' => '2022-09-01',
                'end_date' => '2026-06-30',
                'description' => 'Pursuing degree in Software Engineering. Focused on web development, database design, and software architecture.',
                'is_current' => true,
                'order_number' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            \App\Models\Experience::create($exp);
        }
    }
}
