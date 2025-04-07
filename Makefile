install:
	composer install
	bun install

run:
	docker-compose up -d

publish:
	git push
	ssh ssh.stejs.cz 'bash -s' < publish.sh

build:
	bun build ./src/*.ts --outdir=www/js --public-path="/js" --minify
	bunx @tailwindcss/cli -i ./src/global.css -o ./www/css/global.css --minify

dev.js:
	bun build --watch ./src/*.ts --outdir=www/js --public-path="/js" --sourcemap=inline

dev.css:
	bunx @tailwindcss/cli -i ./src/global.css -o ./www/css/global.css --watch --minify

dev:
	make dev.js& make dev.css
