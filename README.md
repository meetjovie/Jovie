# **Jovie**

## AboutJovie

Jovie is a vue.js SPA with a Laravel backend. It utilizes tailwind css.

## Branching

Our main working branch is **develop**. When you begind working on a feature please pull develop first. Create a new branch and start working on it. When you are done and it has been reviewed, open a pull request to merge it back into develop.

Staging, & Master are for testing and deployment. You should never push to staging or master.

## Deployment

| -------Master------- | -------Staging------- | -------Develop------- |<br> | ![Build Status](https://app.chipperci.com/projects/58d17d0b-dae3-441a-aeff-e24718ab5042/status/master) - | - ![Build Status](https://app.chipperci.com/projects/58d17d0b-dae3-441a-aeff-e24718ab5042/status/staging) ---| -- ![Build Status](https://app.chipperci.com/projects/58d17d0b-dae3-441a-aeff-e24718ab5042/status/develop) | <br> | [Production Site](http://prod.jov.ie 'Production Site') ----- | - [Staging SIte](http://staging.jov.ie 'Staging SIte') ---------- |------- [Dev Site](http://dev.jov.ie 'Dev Site') -------|

**Databases**

Master DB is Jovie_Production Staging DB is jovise-staging-restore Dev db is Jove_Dev

**Dev Ops**

Jovie runs on AWS via Laravel Vapor. Vapor provides some unique functionality that we leverage to make things easier on ourselfs. Familiarize yourself with Vapor by reading through the documentation here: https://docs.vapor.build/
