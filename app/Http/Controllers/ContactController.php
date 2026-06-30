<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageReceived;

class ContactController extends Controller
{
    /**
     * Show contact page
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:500',
            'message' => 'required|string',
        ]);

        // Save to database
        $message = Message::create($validated);

        // Send email notification to admin
        try {
            $adminEmail = config('mail.admin_email', env('ADMIN_EMAIL', 'hussain@example.com'));
            Mail::to($adminEmail)->send(new ContactMessageReceived([
                'name' => $message->name,
                'email' => $message->email,
                'subject' => $message->subject,
                'message' => $message->message,
                'created_at' => $message->created_at->format('Y-m-d H:i:s')
            ]));
        } catch (\Exception $e) {
            \Log::error('Contact email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully! I will get back to you soon.');
    }

    /**
     * AI Chatbot endpoint - answers FAQs automatically
     * Simulates a sales agent that talks about skills, projects, availability
     */
    public function chatbot(Request $request)
    {
        $request->validate(['question' => 'required|string']);

        $question = strtolower(trim($request->question));
        $response = $this->generateChatbotResponse($question);

        return response()->json([
            'response' => $response,
            'timestamp' => now()->format('h:i A')
        ]);
    }

    /**
     * Generate intelligent response based on keywords
     */
    private function generateChatbotResponse($question)
    {
        // Fetch data from DB for dynamic responses
        $skills = \App\Models\Skill::where('is_featured', true)->orderBy('category')->get()->groupBy('category');
        $projects = \App\Models\Project::where('is_featured', true)->take(3)->get();
        $profile = [
            'name' => 'Muhammad-ul-Hussain (Hux_Ain)',
            'phone' => '03341022301',
            'email' => 'hussain@example.com', // Update with real email
            'title' => 'Full-Stack Laravel Developer',
            'company' => 'Gerry\'s IT',
            'availability' => 'Available for freelance/contract work'
        ];

        // Keyword matching
        if (str_contains($question, 'hello') || str_contains($question, 'hi') || str_contains($question, 'hey')) {
            return "Hello! I'm an AI assistant representing {$profile['name']}. {$profile['availability']}. How can I help you today?";
        }

        if (str_contains($question, 'name') || str_contains($question, 'who')) {
            return "I'm an AI chatbot for {$profile['name']}, a {$profile['title']} currently working at {$profile['company']}. I can tell you about his skills, projects, and availability.";
        }

        // Skills
        if (str_contains($question, 'skill') || str_contains($question, 'tech') || str_contains($question, 'know')) {
            $skillList = [];
            foreach ($skills as $category => $catSkills) {
                $skillNames = $catSkills->pluck('name')->implode(', ');
                $skillList[] = ucfirst($category) . ': ' . $skillNames;
            }
            return "Here are the key skills:\n\n" . implode("\n", $skillList) . "\n\nWould you like details on any specific technology?";
        }

        // Projects
        if (str_contains($question, 'project') || str_contains($question, 'portfolio') || str_contains($question, 'work')) {
            $projectList = $projects->map(function($p) {
                return "• {$p->title} (" . implode(', ', json_decode($p->tech_stack, true)) . ")";
            })->implode("\n");
            return "Featured projects:\n\n{$projectList}\n\nYou can see all projects on the portfolio page. Would you like to know more about any specific project?";
        }

        // Contact / Phone
        if (str_contains($question, 'contact') || str_contains($question, 'phone') || str_contains($question, 'call') || str_contains($question, 'number')) {
            return "You can reach {$profile['name']} directly at:\n📞 Phone: {$profile['phone']}\n📧 Email: {$profile['email']}\n\nOr fill out the contact form and he'll get back to you shortly!";
        }

        // Availability / Hire
        if (str_contains($question, 'available') || str_contains($question, 'hire') || str_contains($question, 'freelance') || str_contains($question, 'job') || str_contains($question, 'work')) {
            return "Yes! {$profile['name']} is {$profile['availability']}. He specializes in Laravel development, REST APIs, and Linux deployments. Feel free to contact him to discuss your project!";
        }

        // Education / Experience
        if (str_contains($question, 'education') || str_contains($question, 'study') || str_contains($question, 'university')) {
            return "He's currently pursuing BS Software Engineering at Iqra University (expected 2026). He also has hands-on experience as a Web Developer at Gerry's IT. The experience section has more details.";
        }

        // Default
        return "I'm an AI bot, so I can answer questions about:\n• Skills & Technologies\n• Projects & Work\n• Contact info (phone/email)\n• Availability for hire\n• Education & Experience\n\nIf you need specific details, please leave a message or call directly at {$profile['phone']}.";
    }
}
