#!/bin/bash
set -e

mkdir -p storage

if [ ! -f storage/users.json ]; then
    if [ -f storage/users.seed.json ]; then
        cp storage/users.seed.json storage/users.json
    else
        echo '[]' > storage/users.json
    fi
fi

if [ ! -f storage/transactions.json ]; then
    if [ -f storage/transactions.seed.json ]; then
        cp storage/transactions.seed.json storage/transactions.json
    else
        echo '[]' > storage/transactions.json
    fi
fi

exec bash start.sh
