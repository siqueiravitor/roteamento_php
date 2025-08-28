# Iniciando o projeto
Para rodar o projeto localmente, use o servidor embutido do PHP apontando para a pasta `public`.

## 1. Inicie o servidor

No terminal, execute:
```bash
php -S localhost:80 -t public
```
- `localhost:80` → O projeto ficará disponível no navegador acessando:
http://localhost
- `-t public` → Define que a pasta public é o diretório raiz do servidor.

## 2. Estrutura recomendada

Sua estrutura deve estar assim:
```bash
project-root/
├── public/        # Pasta raiz do servidor
│   ├── index.php  # Arquivo inicial
│   └── ...
├── app/
│   ├── Controller/
│   ├── View/
│   └── Routes/
└── README.md
```

# Sistema de Rotas

Este projeto utiliza uma função route() para mapear URLs para arquivos de views (Front-end) ou actions (Back-end). <br>
Além disso, conta com a função redirect() para facilitar redirecionamentos entre rotas.

## Conceitos

`route($url, $handler)` registra uma rota.

A rota retorna um dos campos:

- `['view' => 'nome']` → renderiza um arquivo de view.
- `['action' => 'nome']` → executa um arquivo de controller/action.

`redirect($url)` redireciona para outra rota.

---

## Definindo rotas

Front-end (views)
```php
route('/inicio', function () {
    return ['view' => 'home'];
});
```
- `/inicio` é a URL.
- `home` é o arquivo de view carregado.

Back-end (actions)
```php
route('/login', function () {
    return ['action' => 'auth'];
});
```
- `/login` é a URL.
- `auth` é o arquivo de action/controller executado.

Mesmo nome para `view` e `action`
É permitido reutilizar o mesmo nome para `view` e `action`, desde que as URLs sejam diferentes (não podem apontar para a mesma URL).

```php
// FRONT
route('/unidades/cadastrar', function () {
    return ['view' => 'cadastrar'];
});

// BACK
route('/unidades/registrar', function () {
    return ['action' => 'cadastrar'];
});
```

> ✅ Mesmo nome lógico (cadastrar) em camadas diferentes. <br>
> ❌ URLs não podem ser iguais.

---

## Redirect
Use `redirect()` em controllers para fluxos mais práticos.

```php
// Após processar POST em /unidades/registrar:
redirect('/unidades/cadastrar');
// ou
redirect('cadastrar'); // se houver alias/suporte a rota relativa
```

> Recomenda-se adicionar `redirect()` ao final de cada arquivo de rotas quando necessário para padronizar o fluxo.

---

Organização de arquivos

- ✅ Correto desde que as rotas não apontem para a mesma url:
```bash
Controller/unidades/cadastrar
View/unidades/cadastrar
```

- ✅ Correto:
```bash
Controller/unidades/registrar
View/unidades/cadastrar
```

- ✅ Alternativa:
```bash
Controller/unidades/cadastrar
View/unidades/registrar
```

> Mantenha telas gerais (ex.: dashboard) centralizadas em index.php.

---

Boas práticas

- Cada rota retorna apenas `view` ou `action`.
- URLs são únicas. `view` e `action` podem compartilhar nome, mas não a mesma URL.
- Use `redirect()` para clareza de navegação após POST/ações.
- Centralize rotas principais e telas comuns em `index.php`.

---

Exemplos completos
1) Rota de tela inicial (Front)
```php
route('/inicio', function () {
    return ['view' => 'home'];
});
```

3) Rota de autenticação (Back)
```php
route('/login', function () {
    return ['action' => 'auth'];
});
```

4) Cadastro (mesmo nome em camadas diferentes)

```php
// FRONT
route('/unidades/cadastrar', function () {
    return ['view' => 'cadastrar'];
});

// BACK
route('/unidades/registrar', function () {
    return ['action' => 'cadastrar'];
});
```

4) Controller com POST + redirect

```php
// Controller/unidades/registrar.php
<?php
// Exemplo simples de captura (PHP)
$nome  = $_POST['nome']  ?? null;
$email = $_POST['email'] ?? null;

// ... validação, persistência, etc.

redirect('/unidades/cadastrar'); // ou redirect('cadastrar');
```
