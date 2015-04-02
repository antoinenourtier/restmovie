# restmovie

## Virtualhost

Modifier le fichier `/etc/hosts` :

`127.0.0.1 restmovie.dev`

Modifier le fichier `/etc/apache2/extra/httpd-vhosts.conf` avec :

```
<VirtualHost *:80>
  ServerName restmovie.dev
  DocumentRoot "/Users/BaptisteLecocq/Workspace/restmovie"

  <Directory "/Users/BaptisteLecocq/Workspace/restmovie">
    Options FollowSymLinks
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
```

Puis redémarrer apache avec :

`sudo apachectl restart`
