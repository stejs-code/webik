#!/bin/zsh
PATH="/home/stejs/.bun/bin:$PATH"
cd /home/stejs/server/webik
bun -v
git pull
make install
make build
