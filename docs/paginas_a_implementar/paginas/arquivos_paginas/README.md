# Conecte - Réplica de Páginas

Projeto de replicação das páginas do Conecte usando **PHP, HTML, CSS e JavaScript**.

## 📋 Estrutura do Projeto

```
conecte_php/
├── css/
│   ├── global.css          # CSS global com variáveis e reset
│   └── componentes.css     # CSS para componentes específicos
├── components/
│   ├── navbar.php          # Componente navbar reutilizável
│   └── footer.php          # Componente footer reutilizável
├── pages/
│   ├── index.php           # Página Home
│   ├── cadastro.php        # Página Cadastro
│   ├── sobre-nos.php       # Página Sobre Nós
│   ├── contatos.php        # Página Contatos
│   └── login.php           # Página Login
├── js/
│   └── main.js             # JavaScript principal
├── assets/                 # Imagens e ícones (vazio)
└── README.md              # Este arquivo
```

## 🎨 Variáveis CSS

O projeto utiliza variáveis CSS para facilitar a manutenção e personalização:

### Cores Principais
```css
--color-primary: #17a2a2;           /* Teal */
--color-secondary: #f5a623;         /* Laranja */
--color-white: #ffffff;             /* Branco */
--color-text: #333333;              /* Texto */
```

### Espaçamento
```css
--spacing-xs: 0.5rem;
--spacing-sm: 1rem;
--spacing-md: 1.5rem;
--spacing-lg: 2rem;
--spacing-xl: 3rem;
--spacing-xxl: 4rem;
```

### Tipografia
```css
--font-family-sans: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
--font-size-base: 1rem;
--font-size-lg: 1.125rem;
--font-size-xl: 1.5rem;
--font-size-2xl: 2rem;
--font-size-3xl: 2.5rem;
```

## 🚀 Como Usar

### 1. Instalação
Não há dependências externas. Basta ter um servidor PHP instalado.

### 2. Executar Localmente

#### Com PHP Built-in Server
```bash
cd conecte_php
php -S localhost:8000
```

Acesse: `http://localhost:8000/pages/index.php`

#### Com Apache
Coloque a pasta em `htdocs` (XAMPP) ou `www` (WAMP) e acesse via navegador.

### 3. Estrutura de Includes

Cada página PHP segue este padrão:

```php
<?php
$current_page = 'home'; // Define página ativa
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/componentes.css">
</head>
<body>
  <!-- Incluir Navbar -->
  <?php include '../components/navbar.php'; ?>
  
  <!-- Conteúdo da página -->
  
  <!-- Incluir Footer -->
  <?php include '../components/footer.php'; ?>
  
  <script src="../js/main.js"></script>
</body>
</html>
```

## 📄 Páginas Disponíveis

### Home (`index.php`)
- Hero section com call-to-action
- Destaques da plataforma (4 cards)
- Seção "Quem somos nós?"
- Por que usar o Conecte (4 cards com bordas)
- Estatísticas (4 números)

### Cadastro (`cadastro.php`)
- Duas opções de cadastro (Buscando cuidador / Oferecendo cuidado)
- Seção "Como Funciona?" com 4 passos

### Sobre Nós (`sobre-nos.php`)
- Descrição do projeto
- Missão, Visão e Valores (3 cards)
- Lista de colaboradores com links

### Contatos (`contatos.php`)
- Formulário de contato (WhatsApp, Instagram, Facebook)
- Mapa Google Maps integrado

### Login (`login.php`)
- Formulário de autenticação
- Links para cadastro e recuperação de senha

## 🎯 Componentes Reutilizáveis

### Navbar (`components/navbar.php`)
- Menu responsivo
- Links ativos dinâmicos
- Toggle para mobile

```php
<?php
$current_page = 'home';
include 'components/navbar.php';
?>
```

### Footer (`components/footer.php`)
- Links rápidos
- Redes sociais
- Informações institucionais

```php
<?php
include 'components/footer.php';
?>
```

## 🎨 Classes CSS Úteis

### Botões
```html
<button class="btn btn-primary">Primário</button>
<button class="btn btn-secondary">Secundário</button>
<button class="btn btn-outline-primary">Outline</button>
<button class="btn btn-lg btn-block">Grande e Full Width</button>
```

### Cards
```html
<div class="card">Conteúdo</div>
<div class="card card-border-primary">Com borda teal</div>
<div class="card card-icon">Com ícone</div>
```

### Seções
```html
<section class="section">Conteúdo normal</section>
<section class="section section-light">Fundo cinza</section>
<section class="section section-primary">Fundo teal</section>
```

### Grid
```html
<div class="cards-grid">
  <div class="card">Card 1</div>
  <div class="card">Card 2</div>
  <div class="card">Card 3</div>
</div>
```

### Utilitários
```html
<div class="text-center">Centralizado</div>
<div class="text-primary">Texto teal</div>
<div class="mt-lg">Margem superior grande</div>
<div class="flex flex-center gap-md">Flex centralizado com gap</div>
```

## 📱 Responsividade

O projeto é **mobile-first** e responsivo em:
- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px
- **Mobile**: < 768px

Breakpoints principais:
```css
@media (max-width: 768px) { /* Tablet e Mobile */ }
@media (max-width: 480px) { /* Mobile pequeno */ }
```

## 🔧 Customização

### Alterar Cores Primárias
Edite `css/global.css`:

```css
:root {
  --color-primary: #17a2a2;      /* Altere aqui */
  --color-secondary: #f5a623;    /* Altere aqui */
}
```

### Alterar Fontes
Edite `css/global.css`:

```css
:root {
  --font-family-sans: 'Sua Fonte', sans-serif;
  --font-family-serif: 'Sua Fonte', serif;
}
```

### Adicionar Novas Páginas
1. Crie `pages/nova-pagina.php`
2. Inclua navbar e footer
3. Defina `$current_page = 'nova-pagina'`
4. Adicione link na navbar

## 🚀 Deploy

### Opção 1: Shared Hosting (cPanel)
1. Compacte a pasta `conecte_php`
2. Upload via FTP ou File Manager
3. Descompacte no servidor
4. Acesse via domínio

### Opção 2: VPS/Cloud
1. Clone o repositório
2. Configure servidor PHP
3. Configure virtual host
4. Acesse via domínio

### Opção 3: Docker
```dockerfile
FROM php:8.0-apache
COPY conecte_php/ /var/www/html/
```

## 📝 Notas Importantes

- **Sem dependências externas**: Funciona com PHP puro
- **Bootstrap não utilizado**: CSS customizado com variáveis
- **Responsivo**: Funciona em todos os dispositivos
- **Acessível**: Semântica HTML correta
- **Modular**: Fácil de manter e expandir

## 🔐 Segurança

Para produção, considere:
- Validar inputs no backend
- Usar prepared statements para banco de dados
- Implementar CSRF tokens
- Sanitizar outputs
- Usar HTTPS

## 📞 Suporte

Para dúvidas sobre o projeto, consulte:
- Documentação CSS em `css/global.css`
- Exemplos em cada página
- Comentários no código

---

**Desenvolvido com ❤️ para o Conecte**
