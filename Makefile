ROOT_DIR = $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))
APP_NAME = Phalcon Documentation Website

SHELL ?= /bin/bash
ARGS = $(filter-out $@,$(MAKECMDGOALS))

BUILD_ID ?= $(shell /bin/date "+%Y%m%d-%H%M%S")

.SILENT: ;               # no need for @
.ONESHELL: ;             # recipes execute in same shell
.NOTPARALLEL: ;          # wait for this target to finish
.EXPORT_ALL_VARIABLES: ; # send all vars to shell
Makefile: ;              # skip prerequisite discovery

# Run make help by default
.DEFAULT_GOAL = help

ifneq ("$(wildcard ./VERSION)","")
VERSION ?= $(shell cat ./VERSION | head -n 1)
else
VERSION ?= 0.0.1
endif

# Public targets
.PHONY: .title
.title:
	$(info $(APP_NAME) v$(VERSION))

.PHONY: up
up: check
	docker-compose up -d

.PHONY: bash
bash:
	docker-compose exec app bash

.PHONY: prune
prune:
	docker-compose down
	docker system prune -f

.PHONY: reset
reset: prune up

.PHONY: help
help: .title
	echo ''
	echo 'Usage: make [target] [ENV_VARIABLE=ENV_VALUE ...]'
	echo ''
	echo 'Available targets:'
	echo ''
	echo '  help       Show this help and exit'
	echo '  up         Starts and attaches to containers for a service'
	echo '  bash       Go to the application container (if any)'
	echo '  prune      Stop, kill and purge project containers.'
	echo '             Also this coman will remove all volumes'
	echo ''

%:
	@:
