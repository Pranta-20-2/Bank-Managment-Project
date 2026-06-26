#!/bin/bash
set -e

mkdir -p storage

if [ ! -f storage/users.json ]; then
    cp storage/users.seed.json storage/users.json
fi

if [ ! -f storage/transactions.json ]; then
    cp storage/transactions.seed.json storage/transactions.json
fi

exec bash start.sh
