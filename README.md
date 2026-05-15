# installer node.js

Prendre la version LTS

https://nodejs.org/en/download

ne rien cocher (sauf conf si demande)

## installer sass

ouvrir un terminal

```npm install -g sass```

si message: npm : Impossible de charger le fichier C:\Program Files\nodejs\npm.ps1, car l’exécution de scripts est désactivée sur
ce système. Pour plus d’informations, consultez about_Execution_Policies à l’adresse

```Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser```

## pour démarrer sass 

```sass ./assets/style.scss ./build/style.css --style=compressed --watch```