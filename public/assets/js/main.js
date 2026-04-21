/**
 * CONECTE - ARQUIVO JAVASCRIPT PRINCIPAL
 * Funcionalidades gerais do site
 */

// ============================================
// INICIALIZAÇÃO DO DOCUMENTO
// ============================================

document.addEventListener('DOMContentLoaded', function () {
    console.log('Conecte - Página carregada');

    // Inicializar funcionalidades
    initNavbar();
    initSmoothScroll();
    initFormValidation();
});

// ============================================
// NAVBAR - MOBILE MENU
// ============================================

function initNavbar() {
    const navbarToggle = document.getElementById('navbarToggle');

    if (navbarToggle) {
        navbarToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleNavbar();
        });
    }

    // Fechar menu ao clicar fora
    document.addEventListener('click', function (e) {
        const navbar = document.querySelector('.navbar');
        const menu = document.getElementById('navbarMenu');
        const buttons = document.getElementById('navbarButtons');

        if (navbar && !navbar.contains(e.target) && menu && buttons) {
            menu.classList.remove('active');
            buttons.classList.remove('active');
        }
    });
}

function toggleNavbar() {
    const menu = document.getElementById('navbarMenu');
    const buttons = document.getElementById('navbarButtons');

    if (menu && buttons) {
        menu.classList.toggle('active');
        buttons.classList.toggle('active');
    }
}

// ============================================
// SMOOTH SCROLL
// ============================================

function initSmoothScroll() {
    // Links internos com smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            // Ignorar links vazios
            if (href === '#') {
                return;
            }

            e.preventDefault();

            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// ============================================
// VALIDAÇÃO DE FORMULÁRIOS
// ============================================

function initFormValidation() {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
}

function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.style.borderColor = '#e74c3c';
            isValid = false;
        } else {
            input.style.borderColor = '';
        }

        // Validação de email
        if (input.type === 'email' && input.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                input.style.borderColor = '#e74c3c';
                isValid = false;
            }
        }
    });

    return isValid;
}

// ============================================
// UTILITÁRIOS
// ============================================

/**
 * Animar elementos ao fazer scroll
 */
function observeElements() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.card, .section').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Adicionar classe ativa ao link da navbar baseado na página atual
 */
function setActiveNavLink() {
    const currentPage = document.body.getAttribute('data-page');

    if (currentPage) {
        document.querySelectorAll('.navbar-menu a').forEach(link => {
            link.classList.remove('active');

            if (link.getAttribute('href').includes(currentPage)) {
                link.classList.add('active');
            }
        });
    }
}

/**
 * Mostrar notificação
 */
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 1.5rem;
    background-color: ${type === 'success' ? '#27ae60' : type === 'error' ? '#e74c3c' : '#3498db'};
    color: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    animation: slideIn 0.3s ease-in-out;
  `;

    document.body.appendChild(notification);

    // Remover após 3 segundos
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-in-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

/**
 * Debounce para otimizar eventos
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Throttle para otimizar eventos
 */
function throttle(func, limit) {
    let inThrottle;
    return function (...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ============================================
// ANIMAÇÕES CSS
// ============================================

const style = document.createElement('style');
style.textContent = `
  @keyframes slideIn {
    from {
      transform: translateX(400px);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes slideOut {
    from {
      transform: translateX(0);
      opacity: 1;
    }
    to {
      transform: translateX(400px);
      opacity: 0;
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  @keyframes slideUp {
    from {
      transform: translateY(20px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  .animate-in {
    animation: slideUp 0.6s ease-out;
  }
`;
document.head.appendChild(style);

// ============================================
// INICIALIZAR FUNCIONALIDADES ADICIONAIS
// ============================================

// Chamar após DOM estar pronto
document.addEventListener('DOMContentLoaded', function () {
    observeElements();
    setActiveNavLink();
});

// ============================================
// PREVIEW DE IMAGEM NO CADASTRO
// ============================================

document.addEventListener('DOMContentLoaded', function () {
    const inputImagem = document.getElementById('foto-perfil');
    const previewContainer = document.getElementById('preview-container');
    const previewImg = document.getElementById('preview-img');
    if (inputImagem && previewContainer && previewImg) {
        inputImagem.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewImg.src = '';
                previewContainer.style.display = 'none';
            }
        });
    }
});

// ============================================
// FORM AVATAR EDIT
// ============================================

const avatarInput = document.getElementById('avatarInput');

if (avatarInput) {
    avatarInput.addEventListener('change', function () {
        document.getElementById('avatarForm')?.submit();
    });
}

// ============================================
// CHATBOT
// ============================================

document.addEventListener('DOMContentLoaded', function () {
    const bubble = document.getElementById('chatbot-bubble');
    if (!bubble) return;

    const chatWindow = document.getElementById('chatbot-window');
    const closeBtn = document.getElementById('close-chat');
    const sendBtn = document.getElementById('send-msg');
    const input = document.getElementById('chat-input');
    const messagesContainer = document.getElementById('chat-messages');
    const badge = bubble.querySelector('.notification-badge');

    // Abrir/Fechar Chat
    bubble.addEventListener('click', () => {
        chatWindow.classList.toggle('hidden');
        if (!chatWindow.classList.contains('hidden')) {
            badge.style.display = 'none';
            input.focus();
        }
    });

    closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        chatWindow.classList.add('hidden');
    });

    // Função para enviar mensagem
    function sendMessage() {
        const text = input.value.trim();
        if (text !== "") {
            appendMessage(text, 'user');
            input.value = "";

            fetch('/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ mensagem: text })
            })
                .then(res => res.json())
                .then(data => {
                    appendMessage(data.resposta, 'bot');
                })
                .catch(() => {
                    appendMessage("Erro ao conectar com o servidor.", 'bot');
                });
        }
    }

    function appendMessage(text, side) {
        const msgDiv = document.createElement('div');
        msgDiv.classList.add('message', side);
        msgDiv.innerHTML = text;
        messagesContainer.appendChild(msgDiv);

        // Scroll automático para o final
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Eventos de envio
    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
});


// ============================================
// PERFIL DO CUIDADOR - MODAL
// ============================================


document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('perfilModal');

    if (!modal) return;

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.dataset.id;
        const nome = button.dataset.nome;
        const foto = button.dataset.foto;
        const bio = button.dataset.bio;
        const cidade = button.dataset.cidade;
        const especialidades = button.dataset.especialidades;


        modal.querySelector('#modal-nome').textContent = nome;
        modal.querySelector('#modal-cidade').textContent = cidade;
        modal.querySelector('#modal-bio').textContent = bio;

        const especialidadesContainer = modal.querySelector('#modal-especialidades');

        especialidadesContainer.innerHTML = '';
        if (especialidades) {
            especialidades.split(',').forEach(especialidade => {
                const span = document.createElement('span');
                span.className = 'badge-tag';
                span.textContent = especialidade.trim();
                especialidadesContainer.appendChild(span);
            });
        }


        // Atualiza imagem
        const img = modal.querySelector('#modal-avatar');

        if (foto) {
            img.src = '/storage/caregivers/' + foto;
        } else {
            img.src = ''; // ou imagem padrão
        }

        console.log("ID:", id);
    });
});


// ============================================
// Avaliaçao - MODAL
// ============================================

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalAvaliacao');

    if (!modal) return;

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.dataset.id;
        const nome = button.dataset.nome;
        const foto = button.dataset.foto;
        const inicio = button.dataset.inicio;
        const fim = button.dataset.fim;


        modal.querySelector('#modal-caregiver-id').value = id;
        modal.querySelector('#modal-nome').textContent = nome;
        modal.querySelector('#modal-inicio').textContent = inicio;
        modal.querySelector('#modal-fim').textContent = fim;


        // Atualiza imagem
        const img = modal.querySelector('#modal-avatar');

        if (foto) {
            img.src = '/storage/caregivers/' + foto;
        } else {
            img.src = ''; // ou imagem padrão
        }

        console.log("ID:", id);
    });
});
