<div align="center">
    
# DOCUMENTO DA APLICAÇÃO WEB 

## ![Logo LightMode](App/public/assets/imgs/logos/logoescura.svg#gh-light-mode-only)![Logo DarkMode](App/public/assets/imgs/logos/logobranca.svg#gh-dark-mode-only)

Plataforma digital que conecta cuidadores de saúde a pacientes que necessitam de acompanhamento e cuidados médicos.

### CENTRO PAULA SOUZA - FACULDADE DE TECNOLOGIA DE JAHU  

### CURSO DE TECNOLOGIA EM DESENVOLVIMENTO DE SOFTWARE MULTIPLATAFORMA  

**Jahu, SP**  

**Início: 1º semestre/2025**  
</div>

**Autores:**  
- [Vinicius Leonardo Silveira](https://github.com/vinisilveiraa);
- [William Matias de Oliveira](https://github.com/WilliamMatiasDeOliveira)

---

# 0. SUMÁRIO  

1. [RESUMO DA APLICAÇÃO WEB](#1-resumo-da-aplicação-web)  
2. [OBJETIVO](#2-objetivo)  
3. [MÉTODOS DA PESQUISA](#3-métodos-da-pesquisa)  
4. [DOCUMENTO DE REQUISITOS](#4-documento-de-requisitos)
   - [Requisitos funcionais](#41-requisitos-funcionais)
   - [Requisitos não funcionais](#42-requisitos-não-funcionais)
5. [REGRAS DE NEGÓCIO](#5-regras-de-negócio)  
6. [ESTUDO DE VIABILIDADE](#6---estudo-de-viabilidade)  
   - [Viabilidade Técnica](#61-viabilidade-técnica)  
   - [Viabilidade Econômica](#62-viabilidade-econômica)  
   - [Viabilidade Operacional](#63-viabilidade-operacional)  
   - [Viabilidade de Mercado](#64-viabilidade-de-mercado)  
7. [MODELO DE DADOS](#7-modelo-de-dados)  
   - [Modelo de Caso de Uso](#71-modelo-de-caso-de-uso)  
   - [Modelo Conceitual](#72-modelo-conceitual)  
   - [Modelo Lógico](#73-modelo-lógico)  
8. [DESIGN](#8-design)  
9. [PROTÓTIPO](#9-protótipo)  
10. [APLICAÇÃO](#10-aplicação)  
11. [CONSIDERAÇÕES FINAIS](#11-considerações-finais)  
12. [REFERÊNCIAS BIBLIOGRÁFICAS](#12-referências-bibliográficas)  

---



## 1. RESUMO DA APLICAÇÃO WEB 

Atualmente, muitas famílias enfrentam dificuldades para encontrar cuidadores de confiança e devidamente qualificados. A busca por esses profissionais geralmente é feita de maneira informal, o que pode resultar em contratações inseguras. Ao mesmo tempo, cuidadores experientes enfrentam dificuldades para divulgar seus serviços. O aumento da expectativa de vida e a necessidade de cuidados especializados em casa tornam esse tema cada vez mais relevante. Este sistema surge como uma resposta moderna, segura e eficiente para aproximar quem precisa de cuidados de quem está capacitado para oferecer. Vivemos em um cenário tecnológico no qual muitas áreas já são digitalizadas. No entanto, o setor de cuidados domiciliares ainda carece de soluções organizadas. Assim, a proposta desta aplicação é centralizar informações, filtrar cuidadores, permitir avaliações e facilitar o contato, oferecendo uma plataforma robusta para a gestão de propostas de serviço e perfis de usuários.
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 2. OBJETIVO  

- Facilitar a busca por cuidadores qualificados com base em filtros como especialidades e localização.  
- Criar perfis detalhados para cuidadores e clientes, permitindo avaliações e histórico de serviços.  
- Valorizar o trabalho dos cuidadores, oferecendo visibilidade profissional e um canal seguro para propostas de serviço.  
- Agilizar o processo de contratação com comunicação e agendamento direto com o cuidador, e gestão de propostas (aceite, recusa, cancelamento, conclusão).  
- Proporcionar segurança e confiabilidade no processo de seleção de cuidadores através de demonstração de seus currículos e sistema de avaliação.  
- Oferecer um chatbot para suporte e informações básicas aos usuários. 
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 3. MÉTODOS DA PESQUISA  

**Como?**  
- Coleta e análise de dados primários (entrevistas e questionários) e secundários (dados estatísticos e artigos).  
- Utilização de metodologia ágil (Scrum).  

**Com o quê?**  
- **Backend:** PHP 8.2+, Laravel 12, MySQL, MongoDB (para chatbot).  
- **Frontend:** Blade Templates, HTML, CSS (TailwindCSS), JavaScript (Vite).  
- **Ferramentas de Design e Modelagem:** Visual Paradigm, Figma.   

**Onde?**  
- Ambientes virtuais: entrevistas online, desenvolvimento em ambiente local e posterior hospedagem online.  

**Quando?**  
- Etapa 1: Pesquisa e levantamento de requisitos.  
- Etapa 2: Prototipação e validação.  
- Etapa 3 e 4: Desenvolvimento.  
- Etapa 5: Testes e ajustes.  
- Etapa 6: Entrega final e documentação.  
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 4. DOCUMENTO DE REQUISITOS  

Este documento especifica as funcionalidades esperadas da aplicação.  

### 4.1 Requisitos funcionais  

- **RF01:** O sistema deve permitir o **cadastro de cuidadores** com informações como nome, email, CPF, senha, telefone, foto, currículo, Coren (opcional) ou certificado de cuidador (opcional), biografia e especialidades.
- **RF02:** O sistema deve permitir o **cadastro de clientes** com nome, email, CPF, senha, telefone e foto.  
- **RF03:** Após o cadastro, o usuário poderá realizar **login** na plataforma (email, senha) e ter acesso ao seu dashboard específico (cliente ou cuidador).  
- **RF04:** O cliente poderá **visualizar o perfil de cuidadores** cadastrados na plataforma, com filtros por especialidade, localização e avaliações.  
- **RF05:** O cuidador poderá **gerenciar suas especialidades**, adicionando ou removendo-as de seu perfil.  
- **RF06:** O cliente poderá **enviar propostas de serviço** a cuidadores, especificando valor, datas de início e fim, descrição e endereço do serviço.  
- **RF07:** O cuidador poderá **aceitar ou recusar propostas** de serviço recebidas.  
- **RF08:** O cliente poderá **cancelar propostas** de serviço enviadas.  
- **RF09:** O sistema deve **atualizar automaticamente o status das propostas** para 'concluída' após a data de término do serviço (se aceita) e para 'expirada' se a data de início for ultrapassada (se pendente).  
- **RF10:** O cliente poderá **visualizar o histórico de contratações**, incluindo o status das propostas e informações do cuidador.  
- **RF11:** O cuidador poderá **visualizar o histórico de propostas** recebidas, incluindo o status e informações do cliente.  
- **RF12:** O cliente poderá **avaliar um cuidador** (rating de 1 a 5 estrelas e comentário) após a conclusão de um serviço.  
- **RF13:** O sistema deve fornecer um **chatbot** para responder a perguntas frequentes e auxiliar os usuários.  
- **RF14:** O sistema deve permitir a **recuperação de senha** via email.  
- **RF15:** O sistema deve permitir a **edição do perfil** (dados pessoais e avatar) para clientes e cuidadores.

### 4.2 Requisitos não funcionais  

- **RNF01:** Disponibilidade 24/7.  
- **RNF02:** Responsividade (mobile, tablet e desktop).  
- **RNF03:** Desempenho (resposta < 2s).  
- **RNF04:** Criptografia de dados sensíveis.  
- **RNF05:** Conformidade com a LGPD.  
- **RNF06:** Usabilidade (UI simples e UX validada).  
- **RNF07:** Suporte inicial a 1000 usuários simultâneos.  
- **RNF08:** Backups automáticos.  
- **RNF09:** Interface intuitiva e acessível.  
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 5. REGRAS DE NEGÓCIO  

- **Gestão de Propostas:** Uma proposta de serviço pode ter os status: `pending` (pendente), `accepted` (aceita), `rejected` (rejeitada), `completed` (concluída), `cancelled` (cancelada) ou `expired` (expirada).  
- **Autorização de Ações:** Apenas o cuidador pode aceitar ou recusar uma proposta. Apenas o cliente pode cancelar uma proposta.  
- **Conclusão Automática:** Propostas aceitas são automaticamente marcadas como `completed` após a `data_fim`. Propostas pendentes são automaticamente marcadas como `expired` se a `data_inicio` for ultrapassada.  
- **Avaliação de Serviço:** Um cliente só pode avaliar um cuidador para uma proposta que esteja no status `completed` e que ainda não tenha sido avaliada.  
- **Acesso a Perfil do Contratante:** O cuidador somente terá acesso ao perfil do contratante após ter prestado serviço anteriormente (proposta `completed`).
- **Contato com Cuidadores:** Clientes podem entrar em contato com cuidadores através de um botão (WhatsApp) fixado no card de apresentação do cuidador.
- **Visualização de Currículo:** Clientes podem ver os currículos dos cuidadores através de um botão fixado no card de apresentação do cuidador.

  ![Modelo de Regras de negocio](/Modelagens/documentacao/negocios_conecte.png)

<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 6 - ESTUDO DE VIABILIDADE  

### 6.1. Viabilidade Técnica  
Viável – Tecnologias adequadas, gratuitas e acessíveis (PHP, Laravel, MySQL, MongoDB, Vite, TailwindCSS).  

### 6.2. Viabilidade Econômica  
Viável – Baixo investimento, uso de ferramentas gratuitas e de código aberto.  

### 6.3. Viabilidade Operacional  
Viável – Resolve problema real com aderência à LGPD, oferecendo uma plataforma funcional para conexão entre cuidadores e clientes.  

### 6.4. Viabilidade de Mercado  
Viável – Nicho em expansão, pouca concorrência local, oportunidade estratégica para digitalização de serviços de cuidado domiciliar.

<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 7. MODELO DE DADOS  

O modelo de dados da aplicação é baseado em um banco de dados relacional MySQL para a maioria das informações de usuários, propostas e avaliações, e um banco de dados NoSQL MongoDB para o armazenamento das interações do chatbot. As principais entidades incluem: `Users` (clientes e cuidadores), `Clients`, `Caregivers`, `Specialties`, `Caregiver_Specialties` (tabela pivô), `Proposals`, `Payments` e `Reviews`. 

### 7.1 Modelo de Caso de Uso

![Modelo Casos de Uso](Modelagens/documentacao/useCase_conecte.png)

### 7.2 Modelo Conceitual  

![Modelo Conceitual](Modelagens/documentacao/conceitual_conecte.png)

Fonte: Elaborado pelos autores.  

### 7.3 Modelo Lógico  

![Modelo Entidade Relacionamento](Modelagens/documentacao/der_conecte.jpeg)

Fonte: Elaborado pelos autores.  
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 8. DESIGN  

### 8.1 Paleta de cores  

|    Nivel   |  Descrição  |   Hex   | Cor       
|:----------:|:-----------:|:-------:|--------------------------------------------------|
|  Primária  |    Verde    | #17a2a2 | ![](https://placehold.co/30x15/17a2a2/17a2a2.png) |
| Secundária |   Amarelo   | #f5a623 | ![](https://placehold.co/30x15/f5a623/f5a623.png)|

### 8.2 Cores e Estilo  
A escolha das cores azul e branco para compor a página foi feita para transmitir sensações de confiança, tranquilidade e profissionalismo. 

<strong>Azul →</strong> é amplamente associado à segurança, saúde e tecnologia, além de ser uma cor que inspira calma e credibilidade. 

<strong>Branco →</strong>  reforça a ideia de limpeza, clareza e simplicidade, tornando a navegação mais leve e agradável. 

Juntas, essas cores criam um ambiente acolhedor e confiável, essencial para uma plataforma voltada ao cuidado e bem-estar.

### 8.3 Tipografia  
|  Descrição   |   Nome    |
|:------------:|:-----------
|  Primária    |  Segoe UI  |
|  Secundária  |   Georgia  |

### 8.4 Imagotipo  


<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 9. PROTÓTIPO  

Protótipo disponível no Figma: [Link para o figma](https://www.figma.com)  
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 10. APLICAÇÃO  

A aplicação foi desenvolvida utilizando **PHP 8.2+** e o framework **Laravel 12** para o backend, com **MySQL** como banco de dados relacional principal e **MongoDB** para o armazenamento de dados do chatbot. O frontend foi construído com **Blade Templates**, **HTML**, **CSS** (utilizando **TailwindCSS** para estilização) e **JavaScript** (com **Vite** para o processo de build).  

As principais funcionalidades implementadas incluem:

- **Autenticação e Autorização:** Cadastro de dois tipos de usuários (clientes e cuidadores) e sistema de login seguro.  
- **Gestão de Perfis:** Clientes e cuidadores podem criar e editar seus perfis, incluindo informações pessoais, fotos e, para cuidadores, detalhes como currículo, Coren/certificado e especialidades.  
- **Busca de Cuidadores:** Clientes podem pesquisar cuidadores utilizando filtros por especialidade e visualizar seus perfis detalhados.  
- **Gestão de Propostas de Serviço:** Clientes podem enviar propostas de serviço a cuidadores, que por sua vez podem aceitar, recusar ou ter suas propostas automaticamente atualizadas para 'concluída' ou 'expirada'.  
- **Histórico de Serviços:** Clientes e cuidadores podem visualizar seus respectivos históricos de contratações e propostas.  
- **Sistema de Avaliação:** Clientes podem avaliar cuidadores após a conclusão de um serviço, contribuindo para a reputação dos profissionais.  
- **Chatbot:** Um chatbot integrado oferece suporte e respostas a perguntas frequentes dos usuários.  
- **Recuperação de Senha:** Funcionalidade para redefinição de senha via email.  

O layout da aplicação é **responsivo**, garantindo uma experiência de usuário consistente em diferentes dispositivos (mobile, tablet e desktop). Testes de usabilidade foram aplicados durante o desenvolvimento para otimizar a experiência do usuário.

**[IMAGEM PENDENTE: Capturas de tela da aplicação em funcionamento]**

<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 11. CONSIDERAÇÕES FINAIS  

O desenvolvimento da aplicação permitiu compreender o processo de construção de sistemas web com foco social. Apesar das dificuldades (requisitos e validação), a aplicação tem potencial de impacto positivo, conectando cuidadores e famílias de forma segura e organizada. A plataforma oferece uma solução digital para um problema real, promovendo a segurança e a eficiência na contratação de serviços de cuidado domiciliar.

<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 12. REFERÊNCIAS BIBLIOGRÁFICAS  

- BRASIL. Lei Geral de Proteção de Dados (LGPD): Lei nº 13.709, de 14 de agosto de 2018.  
- IBGE. Estatísticas sobre envelhecimento da população.  
- SEBRAE. Modelo Canvas. Disponível em: <https://canvas-apps.pr.sebrae.com.br>.  
- SOMMERVILLE, Ian. *Engenharia de software*. 9. ed. São Paulo: Pearson, 2011. ISBN 978-85-7936-108-1.  
- FIGMA. Disponível em: <https://www.figma.com>.  
- PEREIRA, Rubens Queiroz de Almeida. *BRModelo*. Disponível em: <https://github.com/rquellh/brModelo>.  
- VISUAL PARADIGM. Disponível em: <https://online.visual-paradigm.com>.  
- LARAVEL. Documentação oficial. Disponível em: <https://laravel.com/docs>.  
- MYSQL. Documentação oficial. Disponível em: <https://dev.mysql.com/doc/>.  
- MONGODB. Documentação oficial. Disponível em: <https://www.mongodb.com/docs/>.
- TAILWINDCSS. Documentação oficial. Disponível em: <https://tailwindcss.com/docs>.
- VITE. Documentação oficial. Disponível em: <https://vitejs.dev/guide/>.
- W3C. Web Accessibility Initiative (WAI). Disponível em: <https://www.w3.org/WAI/>.  
- GOOGLE FORMS. Disponível em: <https://docs.google.com/forms/>.  
- MDN Web Docs. HTML, CSS e JavaScript. Disponível em: <https://developer.mozilla.org/>.  
- SCRUM GUIDES. The Scrum Guide. Disponível em: <https://scrumguides.org/>.

<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

