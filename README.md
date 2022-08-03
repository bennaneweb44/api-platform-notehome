# CONFIGURATION

## Environnement

Créer un fichier .env à la racine dont le contenu est :

```ssh
###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=e34f2aa37491fbb7ea8540962be1883c
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
DATABASE_URL="mysql://admin:password@localhost:3306/db_name?serverVersion=5.7&charset=utf8mb4"
# DATABASE_URL="postgresql://admin:password@db:5432/testing_db?serverVersion=12&charset=utf8"
###< doctrine/doctrine-bundle ###

###> nelmio/cors-bundle ###
CORS_ALLOW_ORIGIN='^http?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
###< nelmio/cors-bundle ###

ADMIN_USERNAME='admin'
ADMIN_PASSWORD='password'
ADMIN_EMAIL='your_email@domain.com'
ADMIN_AVATAR='https://example.com/img/avatar.jpg'
```

> 1. Créer la base de données **db_name** dont l'encodage est *utf8mb4_unicode_ci*
> 2. Remplacer les informations d'exemple par les vôtres

# INSTALLATION

## Initialisation

Initialiser le projet

```ssh
make start
```

> NB : **make help** permettera de lister toutes les commandes exécutées

## Sécurité

Nous utilisons ici le bundle [LexikJWTAuthenticationBundle](https://symfony.com/bundles/LexikJWTAuthenticationBundle/current/index.html).

Créer le dossier **config/jwt**
```ssh
mkdir -p config/jwt
```

Générer les clés privée et publique
```ssh
php bin/console lexik:jwt:generate-keypair
```

# EXECUTION

## Authentification

## Fonctionnement

# LIENS UTILES
