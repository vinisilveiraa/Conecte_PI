@section('title', 'Chat - Conecte')
@include('components.header-dashboard')
@include('components.navbar')

<meta name="user-id" content="{{ auth()->id() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- <style>
    /* Ajuste fino para integração com a dashboard existente */
    .dashboard-content {
        padding: var(--spacing-md) !important;
        display: flex;
        flex-direction: column;
    }
</style> --}}


<div class="dashboard-content chat-dashboard">

    <div class="chat-wrapper">

        <!-- Sidebar de Conversas -->
        <aside class="chat-sidebar">
            <div class="chat-sidebar-header">
                <h3>Mensagens</h3>
            </div>

            <div class="conversations-list" id="conversationsList">
                {{--
                <!-- Exemplo de Conversa Ativa -->
                <div class="conversation-item data-conversation-id="${conversation.id}"> active">
                    <div class="conversation-avatar">
                        <img src="https://ui-avatars.com/api/?name=Maria+Silva&background=17a2a2&color=fff"
                            alt="Avatar">
                        <span class="status-indicator online"></span>
                    </div>
                    <div class="conversation-info">
                        <div class="conversation-top">
                            <span class="conversation-name">Maria Silva</span>
                            <span class="conversation-time">10:30</span>
                        </div>
                        <div class="conversation-bottom">
                            <span class="last-message">Olá, gostaria de saber mais sobre o atendimento...</span>
                            <span class="unread-badge">2</span>
                        </div>
                    </div>
                </div>

                <!-- Exemplo de Conversa Lida -->
                <div class="conversation-item">
                    <div class="conversation-avatar">
                        <img src="https://ui-avatars.com/api/?name=João+Santos&background=f5a623&color=fff"
                            alt="Avatar">
                        <span class="status-indicator"></span>
                    </div>
                    <div class="conversation-info">
                        <div class="conversation-top">
                            <span class="conversation-name">João Santos</span>
                            <span class="conversation-time">Ontem</span>
                        </div>
                        <div class="conversation-bottom">
                            <span class="last-message">Obrigado pela atenção!</span>
                        </div>
                    </div>
                </div> --}}

            </div>
        </aside>

        <!-- Área Principal do Chat -->
        <main class="chat-main">

            <div id="emptyChatState" class="empty-chat-state">
                <i class="fas fa-comments"></i>
                <h3>Nenhuma conversa iniciada</h3>
                <p>
                    Entre em contato com um cuidador para começar.
                </p>
            </div>

            <div id="chatContent" style="display:none;">
                <!-- Header do Chat Ativo -->
                <header class="chat-header">
                    <div class="conversation-avatar chat-header-avatar">
                        <img id="chatUserAvatar" src="https://ui-avatars.com/api/?name=User&background=17a2a2&color=fff"
                            alt="Avatar">
                    </div>
                    <div class="chat-header-info">
                        <h4 id="chatUserName"></h4>
                        <span>Online agora</span>
                    </div>
                </header>
                <!-- Container de Mensagens -->
                <div class="messages-container" id="chatMessages">
                    <!-- Mensagem Recebida (Esquerda) -->
                    {{-- <div class="message received">
                        Olá! Vi seu perfil e gostaria de agendar uma visita para semana que vem. Você tem
                        disponibilidade na
                        quarta-feira?
                        <span class="message-time">10:25</span>
                    </div>
                    <!-- Mensagem Enviada (Direita) -->
                    <div class="message sent">
                        Olá, Maria! Tudo bem? Tenho disponibilidade sim. Qual seria o melhor horário para você na
                        quarta?
                        <span class="message-time">10:28</span>
                    </div> --}}
                </div>
                <!-- Input de Mensagem -->
                <footer class="chat-input-container">
                    <form action="#" id="chatForm" class="chat-input-wrapper">
                        <textarea name="message" id="messageInput" placeholder="Digite sua mensagem..." rows="1"
                            oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                        <button type="submit" class="btn-send">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </footer>
            </div>
        </main>
    </div>
</div>


@include('components.footer')
<script>
    // Script básico para auto-scroll e exemplo de envio
    document.addEventListener('DOMContentLoaded', async function() {
        const messagesContainer = document.getElementById('chatMessages');
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const conversationsList = document.getElementById('conversationsList');
        const authUserId = document.querySelector('meta[name="user-id"]').content;
        let currentConversationId = null;

        // scroll para o fim das mensagens ao carregar
        messagesContainer.scrollTop = messagesContainer.scrollHeight;


        async function loadConversations() {
            // faz um get para a rota com await
            const response = await fetch('/chat/conversations');
            // converte a resposta para json
            const conversations = await response.json();

            conversationsList.innerHTML = '';



            conversations.forEach(conversation => {
                const otherUser =
                    String(conversation.client_user_id) == String(authUserId) ?
                    conversation.caregiver :
                    conversation.client;

                if (!otherUser) return;

                const time = conversation.last_message_at ?
                    new Date(conversation.last_message_at)
                    .toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    }) :
                    '';
                const avatar = otherUser.foto ?
                    `/storage/caregivers/${otherUser.foto}` :
                    `https://ui-avatars.com/api/?name=${encodeURIComponent(otherUser.nome)}&background=17a2a2&color=fff`;

                const html = `
    <div class="conversation-item"
        data-conversation-id="${conversation.id}"
        data-user-name="${otherUser.nome}"
        data-user-avatar="${avatar}"
        ">

        <div class="conversation-avatar">
            <img
                src="${avatar}"
                alt="Avatar"
            >

            <span class="status-indicator online"></span>
        </div>

        <div class="conversation-info">

            <div class="conversation-top">

                <span class="conversation-name">
                    ${otherUser.nome}
                </span>

                <span class="conversation-time">
                    ${time}
                </span>

            </div>

            <div class="conversation-bottom">

                <span class="last-message">
                    ${conversation.last_message ?? ''}
                </span>

            </div>

        </div>

    </div>
`;
                conversationsList.insertAdjacentHTML('beforeend', html);
            });

            const items = document.querySelectorAll('.conversation-item');

            items.forEach(item => {

                item.addEventListener('click', function() {

                    document.getElementById('emptyChatState')
                        .style.display = 'none';

                    document.getElementById('chatContent')
                        .style.display = 'flex';

                    const conversationId = this.dataset.conversationId;

                    const userName = this.dataset.userName;

                    const userAvatar = this.dataset.userAvatar;

                    document.getElementById('chatUserName').innerText = userName;

                    document.getElementById('chatUserAvatar').src = userAvatar;

                    items.forEach(i => i.classList.remove('active'));

                    this.classList.add('active');

                    currentConversationId = conversationId;

                    loadMessages(conversationId);
                });

            });
        }

        async function loadMessages(conversationId) {

            const response =
                await fetch(`/chat/${conversationId}/messages`);

            const messages = await response.json();

            // console.log(messages);
            messagesContainer.innerHTML = '';

            messages.forEach(message => {

                const time = new Date(message.created_at)
                    .toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                const type =
                    String(message.sender_id) === String(authUserId) ?
                    'sent' :
                    'received';

                const html = `
                    <div class="message ${type}">

                        <div class="message-text">
                            ${message.message.replace(/\n/g, '<br>')}
                        </div>

                        <span class="message-time">
                            ${time}
                        </span>

                    </div>
                `;

                messagesContainer.insertAdjacentHTML(
                    'beforeend',
                    html
                );
            });
            messagesContainer.scrollTop =
                messagesContainer.scrollHeight;

            await fetch(`/chat/${conversationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
        }

        await loadConversations();

        const firstConversation =
            document.querySelector('.conversation-item');

        if (firstConversation) {

            firstConversation.click();

        } else {

            document.getElementById('emptyChatState')
                .style.display = 'flex';

            document.getElementById('chatContent')
                .style.display = 'none';
        }

        async function sendMessage(message) {

            const csrf =
                document.querySelector('meta[name="csrf-token"]').content;

            const response = await fetch('/chat/send', {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    conversation_id: currentConversationId,
                    message: message
                })
            });

            const data = await response.json();

            return data;
        }


        chatForm.addEventListener('submit', async function(e) {

            e.preventDefault();

            const message = messageInput.value.trim();

            if (!message || !currentConversationId) {
                return;
            }
            try {
                const response = await sendMessage(message);

                console.log(response);

                await loadMessages(currentConversationId);

                messageInput.value = '';

                messageInput.style.height = '';

                messagesContainer.scrollTop =
                    messagesContainer.scrollHeight;

            } catch (error) {
                console.error(error);
            }
        });

        // Enviar com Enter (sem Shift)
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatForm.dispatchEvent(new Event('submit'));
            }
        });

        setInterval(() => {

            if (currentConversationId) {
                loadMessages(currentConversationId);
            }

        }, 3000);
    });
</script>
