# Estimator

## Présentation du projet

Estimator est une application web destinée à estimer les temps de développement de projets web. Elle permet de calculer le temps total nécessaire en fonction du type de projet, du type de design, et des développements spécifiques. Les utilisateurs peuvent sélectionner des développements génériques et additionnels pour obtenir une estimation précise.

## Initialisation du projet

### Étapes d'installation

1. Faire une copie du fichier `.env.example` à la racine du projet et le renommer en `.env`.

```sh
cp .env.example .env
```

2. Faire une copie du fichier `.env.example` dans le dossier backend et le renommer en `.env`.

```sh
cp backend/.env.example backend/.env
```

3. Lancer la commande suivante pour construire et démarrer les conteneurs Docker :

```sh
docker-compose up --built
```

4. Une fois les conteneurs démarrés, accéder au conteneur `api` :

```sh
docker-compose exec api bash
```

5. Installer les dépendances PHP avec Composer :

```sh
composer install
```

6. Exécuter les migrations et les seeders :

```sh
php artisan migrate --seed
```

## Accès à l'application

- Frontend : [http://localhost:8080](http://localhost:8080)
- Adminer : [http://localhost:8085](http://localhost:8085)
