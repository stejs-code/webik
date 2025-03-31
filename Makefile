install:
	composer install

run:
	docker-compose up -d

build:
	bun build ./src/*.ts --outdir=www/js --public-path="/js" --minify --splitting 
	bunx @tailwindcss/cli -i ./src/global.css -o ./www/css/global.css --minify

dev.js:
	bun build --watch ./src/*.ts --outdir=www/js --public-path="/js" --sourcemap=inline

dev.css:
	bunx @tailwindcss/cli -i ./src/global.css -o ./www/css/global.css --watch --minify

dev:
	make dev.js& make dev.css
