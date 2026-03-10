
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Cliente - Conecte</title>
  <link rel="stylesheet" href="{{asset('assets/css/global.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/componentes.css')}}">
</head>

<body>
  <!-- NAVBAR -->
    @include('components.navbar')
  <!-- MAIN CONTENT -->
  <main class="cadastro-container">
    <div class="cadastro-wrapper">
      <!-- SEÇÃO ESQUERDA - CTA -->
      <div class="cadastro-sidebar">
        <h2>Cadastre-se<br>Gratuitamente!</h2>
        <p>Preencha os campos abaixo para criar sua conta como cliente.</p>
        <p class="login-link">Já possui uma conta? <a href="login.php">Entre aqui!</a></p>
      </div>

      <!-- SEÇÃO DIREITA - FORMULÁRIO -->
      <div class="cadastro-form-section">
        <form action="{{route('register')}}" method="POST" class="cadastro-form">
            @csrf
          <!-- DADOS PESSOAIS -->
          <div class="form-section">
            <h3 class="form-section-title">Dados Pessoais</h3>

            <div class="form-row" style="grid-template-columns: 1fr;">
              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Digite seu Nome" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for=" cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="CPF" required>
              </div>
              <div class="form-group">
                <label for="rg">RG</label>
                <input type="text" id="rg" name="rg" placeholder="" required>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" placeholder="email@example.com" required>
            </div>
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="tel" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" required>
            </div>
          </div>

          <!-- ENDEREÇO -->
          <div class="form-section">
            <h3 class="form-section-title">Endereço</h3>

            <div class="form-row" style="grid-template-columns: 1fr;">
              <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" placeholder="12456-789" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="rua">Logradouro</label>
                <input type="text" id="rua" name="rua" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" placeholder="" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" placeholder="" required>
              </div>
            </div>
          </div>

          <!-- SEGURANÇA -->
          <div class="form-section">
            <h3 class="form-section-title">Segurança</h3>

            <div class="form-row">
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="password-confirmation">Confirmar Senha</label>
                <input type="password" id="password-confirmation" name="password-confirmation" placeholder="" required>
              </div>
            </div>
          </div>

          <div class="form-section">
            <h3 class="form-section-title">Arquivos</h3>

            <div class="form-row" style="grid-template-columns: 1fr;">
              <div class="form-group">
                <label for="foto-perfil">Foto de Perfil</label>
                <input type="file" id="foto-perfil" name="foto-perfil" accept="image/*">
              </div>
              <div id="preview-container" style="margin-top: 10px; display: none;">
                <img id="preview-img" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
              </div>
            </div>

            <!-- BOTÃO ENVIAR -->
            <button type="submit" class="btn btn-submit">Cadastrar-se</button>
        </form>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  @include('components.footer')
  <script src="{{asset('assets/js/main.js')}}"></script>

