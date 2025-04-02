# Informatika PHP

- produkce jede na [webik.stejs.cz](https://webik.stejs.cz)
- nutné k vývoji
  - [Docker](https://www.docker.com/) – prostředí pro nginx a php-fpm
  - [Bun](https://bun.sh/) – bundler pro javascript a js package installer
  - [Composer](https://getcomposer.org/) – instalace php dependencí a auto require App directory

## Úkoly

Jsou umístěny v `/App/Template/task`, další kód k jejich logice pochází z jejich ovladače `Task`, který je umístěn v `/App/Module/Task.php`

Aktuální verze je zcela neurčená k produkci, plná stabilita aplikace bude dodána až příjde čas.

## Instalace

```bash
make install
```

# Vývoj

## Spuštění php-fpm s nginx

```bash
make start
```

- url: http://localhost:8080

## Tailwindcss + javascript bundler (Bun)

```bash
make dev
```

# Build pro produkci

```bash
make build
```

# Push na produkci

```
make publish
```
