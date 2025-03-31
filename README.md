# Informatika PHP

- produkce jede na [webik.stejs.cz](https://webik.stejs.cz)
- vyžadován docker :)
- vyžadován composer na instalaci (zatím není nepotřeba)

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

## Tailwindcss + javascript bundler (Vite)

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
