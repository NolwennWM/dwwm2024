# Exercice 5 #

Créer un formulaire qui permettra de modifier les propriétés suivantes de notre recette (seulement le côté HTML et CSS, on fera le script ensemble):

- name (input required et `pattern="^[a-zA-Z\sàéèç]{1,50}$"`)
- duration (input required `pattern="^[1-9][0-9]*$"`)
- description (textarea required `pattern=".{5,}(\n|.)*"`)
- type (ne faisons qu'un seul radio pour l'instant) (required )
- ingredients (textarea required `pattern=".{5,}(\n|.)*"`)
- steps (textarea required `pattern=".{5,}(\n|.)*"`)

chacun sauf le type sera suivi d'une div affichant un message correspondant aux erreurs possible.
Je voudrais aussi que le formulaire ne s'affiche que si on a une recette.
