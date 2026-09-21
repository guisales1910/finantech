#!/bin/bash

# Inicia o Symfony em segundo plano
symfony server:start -d

# Inicia o SQLite Web
sqlite_web ~/FinanTech/var/data.db~


