<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embeddable Chatbot Widget</title>
    <!-- Tailwind CSS CDN for basic styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            /* Just for demo page background */
        }

        /* Chatbot container styles - designed to be floating */
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            /* Fixed width for the widget */
            height: 500px;
            /* Fixed height for the widget */
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            /* Hide scrollbar initially */
            z-index: 1000;
            /* Ensure it's above other content */
            transition: all 0.3s ease-in-out;
            transform: translateY(calc(100% - 60px));
            /* Hide most of it, show only header */
            opacity: 0;
            /* Start hidden */
            visibility: hidden;
            /* Start hidden */
        }

        .chatbot-container.open {
            transform: translateY(0);
            /* Slide up to show */
            opacity: 1;
            visibility: visible;
        }

        .chatbot-header {
            background-color: #6366f1;
            /* Indigo 500 */
            color: white;
            padding: 15px 20px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            font-size: 1.125rem;
            /* text-lg */
        }

        .chat-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            /* Enable scrolling for messages */
            background-color: #f9fafb;
            /* Gray 50 */
            display: flex;
            flex-direction: column;
            gap: 10px;
            scroll-behavior: smooth;
            /* Smooth scroll to new messages */
        }

        .message {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 12px;
            word-wrap: break-word;
            /* Ensure long words wrap */
        }

        .message.user {
            background-color: #e0e7ff;
            /* Indigo 100 */
            align-self: flex-end;
            border-bottom-right-radius: 4px;
            /* Pointy corner */
        }

        .message.ai {
            background-color: #e5e7eb;
            /* Gray 200 */
            align-self: flex-start;
            border-bottom-left-radius: 4px;
            /* Pointy corner */
        }

        .chat-input-area {
            display: flex;
            padding: 15px;
            border-top: 1px solid #e5e7eb;
            /* Gray 200 */
            background-color: #ffffff;
        }

        .chat-input {
            flex-grow: 1;
            padding: 10px 15px;
            border: 1px solid #d1d5db;
            /* Gray 300 */
            border-radius: 10px;
            outline: none;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }

        .chat-input:focus {
            border-color: #6366f1;
            /* Indigo 500 */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .send-button {
            background-color: #6366f1;
            /* Indigo 500 */
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            margin-left: 10px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .send-button:hover {
            background-color: #4f46e5;
            /* Indigo 600 */
        }

        .send-button:active {
            transform: translateY(1px);
        }

        .send-button:disabled {
            background-color: #9ca3af;
            /* Gray 400 */
            cursor: not-allowed;
        }

        .loading-indicator {
            text-align: center;
            padding: 10px;
            color: #6b7280;
            /* Gray 500 */
            font-style: italic;
        }
    </style>
</head>

<body>

    <!-- This is the chatbot widget code that clients will embed -->
    <div id="saas-chatbot-widget" class="chatbot-container">
        <div class="chatbot-header" id="chatbot-header-dynamic">
            <span>AI Assistant</span>
            <button id="toggle-chatbot-btn-dynamic" class="text-white text-2xl leading-none">&times;</button>
        </div>
        <div class="chat-messages" id="chat-messages-dynamic">
            <div class="message ai">Hello! How can I help you today?</div>
        </div>
        <div class="chat-input-area">
            <input type="text" id="chat-input-dynamic" class="chat-input" placeholder="Type your message...">
            <button id="send-button-dynamic" class="send-button">Send</button>
        </div>
    </div>

    <script>
        const CHATBOT_API_BASE_URL = 'http://127.0.0.1:8000/api';
        const CHATBOT_ID = 4;

        const chatbotContainer = document.getElementById('saas-chatbot-widget');
        const chatbotHeader = document.getElementById('chatbot-header-dynamic');
        const toggleChatbotBtn = document.getElementById('toggle-chatbot-btn-dynamic');
        const chatMessages = document.getElementById('chat-messages-dynamic');
        const chatInput = document.getElementById('chat-input-dynamic');
        const sendButton = document.getElementById('send-button-dynamic');

        let isChatbotOpen = false;
        let isLoading = false;

        /// Helper functions 

        function appendMessage(sender, text) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', sender);
            messageDiv.textContent = text;
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function showLoadingIndicator() {
            if (!document.getElementById('loading-indicator-dynamic')) {
                const loadingDiv = document.createElement('div');
                loadingDiv.id = 'loading-indicator-dynamic';
                loadingDiv.classList.add('loading-indicator');
                loadingDiv.textContent = 'AI is typing...';
                chatMessages.appendChild(loadingDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;

            }
        }

        function hideLoadingIndicator() {
            const loadingDiv = document.getElementById('loading-indicator-dynamic')
            if (loadingDiv) {
                loadingDiv.remove();
            }
        }

        function toggleChatbot() {
            isChatbotOpen = !isChatbotOpen;
            if (isChatbotOpen) {
                chatbotContainer.classList.add('open');
                toggleChatbotBtn.textContent = 'x';
                chatInput.focus();
            } else {
                chatbotContainer.classList.remove('open');
                toggleChatbotBtn.textContent = '💬';
            }
        }

        async function sendMessage() {
            const userText = chatInput.value.trim();
            if (userText === '' || isLoading) {
                return;
            }

            appendMessage('user', userText);
            chatInput.value = '';
            isLoading = true;
            sendButton.disabled = true;
            showLoadingIndicator();

            try {
                const response = await fetch(`${CHATBOT_API_BASE_URL}/chatbots/${CHATBOT_ID}/chat`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        query: userText
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    appendMessage('ai', data.answer);
                } else {
                    const errorMessage = data.error || data.message || 'Sorry, I encounterd an error';
                    appendMessage('ai', `Error: ${errorMessage}`);
                }
            } catch (error) {
                console.error('Network unexpected error', error);
                appendMessage('ai', 'Opps something went wrong');
            } finally {
                isLoading = false;
                sendButton.disabled = false;
                hideLoadingIndicator()
            }
        }

        /// Event Listeners 

        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') {
                sendMessage();
            }
        });

        chatbotHeader.addEventListener('click', toggleChatbot);
        toggleChatbotBtn.addEventListener('click', (event) => {
            event.stopPropagation()
            toggleChatbot();
        });

        setTimeout(() => {
            chatbotContainer.style.opacity = '1';
            chatbotContainer.style.visibility = 'visible';
        }, 500);

    </script>

</body>

</html>
