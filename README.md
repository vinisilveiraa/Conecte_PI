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
- [William Matias de Oliveira](https://github.com/WilliamMatiasDeOliveira);
- [Lucas Catto Silva](https://github.com/lucas-catto);

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


Atualmente, muitas famílias enfrentam dificuldades para encontrar cuidadores de confiança e devidamente qualificados. A busca por esses profissionais geralmente é feita de maneira informal, o que pode resultar em contratações inseguras.  

Ao mesmo tempo, cuidadores experientes enfrentam dificuldades para divulgar seus serviços.  

O aumento da expectativa de vida e a necessidade de cuidados especializados em casa tornam esse tema cada vez mais relevante.  

Este sistema surge como uma resposta moderna, segura e eficiente para aproximar quem precisa de cuidados de quem está capacitado para oferecer.  

Vivemos em um cenário tecnológico no qual muitas áreas já são digitalizadas. No entanto, o setor de cuidados domiciliares ainda carece de soluções organizadas.  

Assim, a proposta desta aplicação é centralizar informações, filtrar cuidadores, permitir avaliações e facilitar o contato.
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 2. OBJETIVO  

- Facilitar a busca por cuidadores qualificados com base em filtros como especialidades.  
- Criar perfis com avaliações de outros usuários.  
- Valorizar o trabalho dos cuidadores, oferecendo visibilidade profissional.  
- Agilizar o processo de contratação com comunicação e agendamento direto com o cuidador.  
- Proporcionar segurança e confiabilidade no processo de seleção de cuidadores através de demonstração de seus currículos.  
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 3. MÉTODOS DA PESQUISA  

**Como?**  
- Coleta e análise de dados primários (entrevistas e questionários) e secundários (dados estatísticos e artigos).  
- Utilização de metodologia ágil (Scrum).  

**Com o quê?**  
- Google Forms, Visual Paradigm, Figma, HTML, CSS, JavaScript, Laravel, MySQL.  

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

- **RF01:** O sistema deve ser capaz de *CADASTRAR cuidadores* (nome, email, CPF, senha, telefone, foto, curriculo);
- **RF02:** O sistema deve ser capaz de *CADASTRAR clientes* (nome, email, CPF, senha, telefone, foto);
- **RF03:** Apos feito o cadastro, o usuario poderá realizar *LOGIN* na plataforma com ( email, senha ) tendo acesso ao sistema;
- **RF04:** O cliente poderá vizualizar o perfil de qualquer cuidador cadastrado na plataforma através de filtro por especialidade;
- **RF05:** O cuidador somente tera acesso ao perfil do contratante apos ter prestado serviço anteriormente;
- **RF06:** O contratante só podera avaliar ( Deixar um like ) em quem ja prestou serviço a ele.
- **RF07:** Os clientes poderão entrar em contato com cuidores atraves de um botão (WatsApp) fixado no card de apresentação do cuidador;
- **RF08:** Os clientes poderão ver os curriculos dos cuidadores atraves de um botão fixado no card de apresentação do cuidador;
- **RF09:** Todo cuidador já cadastrado poderá ser exibido na pagina de busca;
- **RF10:** O cliente conseguirá ter acesso a todos os seus cuidadores já contratados, através de um botão "Histórico de Contratações" no seu dashboard. Onde sera exibido nome do cuidador data_inicio, data_fim da prestação de serviço;
- **RF11:** O sistema deve fornecer uma barra de pesquisa para clientes para facilitar a busca por cuidadores por especialidade;

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

  ![Modelo de Regras de negocio](/Modelagens/documentacao/negocios_conecte.png)

<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 6 - ESTUDO DE VIABILIDADE  

### 6.1. Viabilidade Técnica  
Viável – Tecnologias adequadas, gratuitas e acessíveis.  

### 6.2. Viabilidade Econômica  
Viável – Baixo investimento, uso de ferramentas gratuitas.  

### 6.3. Viabilidade Operacional  
Viável – Resolve problema real com aderência à LGPD.  

### 6.4. Viabilidade de Mercado  
Viável – Nicho em expansão, pouca concorrência local, oportunidade estratégica.  
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 7. MODELO DE DADOS  

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

|    Nivel   |   Descrição   |   Hex   | Cor       
|:----------:|:-------------:|:-------:|--------------------------------------------------|
|  Primária  |   Azul Claro  | #D1E4F5 | ![](https://placehold.co/30x15/D1E4F5/D1E4F5.png) |
| Secundária |   Azul Médio  | #7997B9 | ![](https://placehold.co/30x15/7997B9/7997B9.png)|
|  Terciária |  Azul Escuro  | #5A7CA0 | ![](https://placehold.co/30x15/5A7CA0/5A7CA0.png) |

### 8.2 Cores e Estilo  
A escolha das cores azul e branco para compor a página foi feita para transmitir sensações de confiança, tranquilidade e profissionalismo. 

<strong>Azul →</strong> é amplamente associado à segurança, saúde e tecnologia, além de ser uma cor que inspira calma e credibilidade. 

<strong>Branco →</strong>  reforça a ideia de limpeza, clareza e simplicidade, tornando a navegação mais leve e agradável. 

Juntas, essas cores criam um ambiente acolhedor e confiável, essencial para uma plataforma voltada ao cuidado e bem-estar.

### 8.3 Tipografia  
|  Descrição  |   Nome    |
|:-----------:|:-----------
|  Títulos    |  Poppins  |
| Texto Padrão|   Nunito  |
|    Logo     | Righteous |

### 8.4 Imagotipo  

O símbolo gráfico escolhido é um círculo em formato de medalha, contendo um coração branco ao centro. O círculo representa união, integridade e acolhimento, enquanto o coração reforça o propósito de cuidado e empatia da plataforma. A medalha sugere reconhecimento e confiança, valores essenciais para conectar cuidadores e pacientes.

O nome da marca, "Conecte", utiliza a fonte Righteous, que transmite modernidade e tecnologia. Essa escolha reforça a proposta inovadora do sistema, ao mesmo tempo em que mantém uma identidade visual amigável e acessível. O conjunto cria uma imagem marcante, profissional e alinhada ao segmento de saúde. 
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

A aplicação foi desenvolvida em PHP, com layout responsivo. Inclui login, busca, visualização de perfil e contato. Testes de usabilidade foram aplicados.  
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

---

## 11. CONSIDERAÇÕES FINAIS  

O desenvolvimento da aplicação permitiu compreender o processo de construção de sistemas web com foco social.  

Apesar das dificuldades (requisitos e validação), a aplicação tem potencial de impacto positivo, conectando cuidadores e famílias de forma segura e organizada.  
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
- W3C. Web Accessibility Initiative (WAI). Disponível em: <https://www.w3.org/WAI/>.  
- GOOGLE FORMS. Disponível em: <https://docs.google.com/forms/>.  
- MDN Web Docs. HTML, CSS e JavaScript. Disponível em: <https://developer.mozilla.org/>.  
- SCRUM GUIDES. The Scrum Guide. Disponível em: <https://scrumguides.org/>.
<div align= "end"> 
    
<sub> [↑ Voltar ao sumário](#0-sumário) </sub>
</div>

