import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const mobileToggle = document.querySelector('[data-mobile-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    const sidebar = document.querySelector('[data-sidebar]');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    }

    const chatbotToggle = document.querySelector('[data-chatbot-toggle]');
    const chatbotPanel = document.querySelector('[data-chatbot-panel]');
    const chatbotForm = document.querySelector('[data-chatbot-form]');
    const chatbotBody = document.querySelector('[data-chatbot-body]');
    const chatbotInput = document.querySelector('[data-chatbot-input]');

    if (chatbotToggle && chatbotPanel) {
        chatbotToggle.addEventListener('click', () => {
            chatbotPanel.classList.toggle('active');
        });
    }

    function appendChatMessage(text, sender) {
        if (!chatbotBody) {
            return;
        }

        const div = document.createElement('div');
        div.className = sender === 'user' ? 'chat-bubble-user' : 'chat-bubble-bot';
        div.textContent = text;
        chatbotBody.appendChild(div);
        chatbotBody.scrollTop = chatbotBody.scrollHeight;
    }

    if (chatbotForm && chatbotInput && chatbotBody) {
        chatbotForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const question = chatbotInput.value.trim();

            if (!question) {
                return;
            }

            appendChatMessage(question, 'user');
            chatbotInput.value = '';

            try {
                const response = await fetch(chatbotForm.dataset.endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: JSON.stringify({ question }),
                });

                const data = await response.json();
                appendChatMessage(data.response || 'Please try again later.', 'bot');
            } catch (error) {
                appendChatMessage('Temporary issue aa gaya hai. Direct contact form use kar lein.', 'bot');
            }
        });
    }

    const techContainer = document.querySelector('[data-tech-container]');
    const techAddButton = document.querySelector('[data-add-tech]');

    if (techContainer && techAddButton) {
        techAddButton.addEventListener('click', () => {
            const wrapper = document.createElement('div');
            wrapper.className = 'flex gap-3';
            wrapper.innerHTML = `
                <input type="text" name="tech_stack[]" class="input-field" placeholder="e.g. Laravel" />
                <button type="button" class="btn-danger !rounded-2xl !px-4 !py-3" data-remove-tech>Remove</button>
            `;
            techContainer.appendChild(wrapper);
        });

        techContainer.addEventListener('click', (event) => {
            const button = event.target.closest('[data-remove-tech]');
            if (button) {
                button.parentElement.remove();
            }
        });
    }

    document.querySelectorAll('[data-proficiency-range]').forEach((range) => {
        const output = document.querySelector(range.dataset.target);
        const updateValue = () => {
            if (output) {
                output.textContent = `${range.value}%`;
            }
        };

        range.addEventListener('input', updateValue);
        updateValue();
    });
});
