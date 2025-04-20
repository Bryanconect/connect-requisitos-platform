# 🚀 Connect Requisitos Platform

Plataforma modular para gestão e elicitação de requisitos de software, com foco em rastreabilidade, colaboração entre áreas e controle de versões das histórias de usuário.

> Projeto desenvolvido com arquitetura em camadas (MVC + Services), validação robusta e geração de relatórios em PDF. Ideal para empresas que desejam profissionalizar o processo de levantamento de requisitos.

---

## 📌 Funcionalidades

- ✅ Cadastro, edição e exclusão de requisitos
- ✅ Gestão de histórias de usuário ligadas a requisitos e elicitações
- ✅ Geração de insights automáticos sobre a qualidade das histórias
- ✅ Autenticação de usuários com controle de acesso por perfil (admin/padrão)
- ✅ Geração de relatórios PDF filtráveis
- ✅ Upload e download de arquivos de elicitação
- ✅ Painel administrativo com controle de usuários e permissões

---

## 🧱 Arquitetura

- Laravel 9
- Camadas separadas:
  - `Controllers`: apenas recebem requisições
  - `Services`: lógica de negócio isolada
  - `Models`: Eloquent ORM
  - `Requests`: validações centralizadas
- View Blade templates com Bootstrap

> Aplicação seguindo princípios de **Clean Code** e boas práticas de separação de responsabilidades.

---

## 🛠️ Tecnologias

- PHP 8.x
- Laravel
- MySQL / MariaDB
- Bootstrap 5
- Barryvdh DomPDF
- Carbon (manipulação de datas)

---

## 👨‍💻 Autor
Seu Nome
    • LinkedIn
    • Portfólio

---

## ⭐ Diferenciais técnicos
    • Separação entre lógica de negócio e controller
    • Geração de PDF com filtros avançados
    • Sistema de insights que analisa texto das histórias automaticamente
    • Controle de status das histórias (Aberta, Concluída, Cancelada)
    • API OpenAI (comentada no código) para expansão futura

---

## 📄 Licença
Este projeto está licenciado sob a MIT License.
