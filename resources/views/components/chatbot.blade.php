<!-- Chatbot Wrapper -->
<div id="chatbot-container" class="chatbot-container">
    <!-- Chat Window -->
    <div id="chatbot-window" class="chatbot-window hidden">
        <div class="chatbot-header">
            <div class="chatbot-header-info">
                <div class="chatbot-avatar">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div>
                    <h4>Suporte Conecte</h4>
                    <span class="status-online">Online agora</span>
                </div>
            </div>
            <button id="close-chat" class="close-btn">&times;</button>
        </div>

        <div id="chat-messages" class="chatbot-messages">
            <div class="message bot">
                Olá! 👋 Como posso ajudar você a encontrar o cuidado ideal hoje?
            </div>
        </div>

        <div class="chatbot-input">
            <input type="text" id="chat-input" placeholder="Digite sua mensagem...">
            <button id="send-msg" class="send-btn">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Floating Bubble -->
    <button id="chatbot-bubble" class="chatbot-bubble">
        <i class="fa-solid fa-robot"></i>
        <span class="notification-badge">1</span>
    </button>
</div>
