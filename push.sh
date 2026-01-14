#!/bin/bash

if [ -z "$1" ]; then
    echo "Erreur : Veuillez fournir un message de commit."
    echo "Utilisation : ./push \"Votre message de commit\""
    exit 1
fi

git add .
echo "✅ Ajout des fichiers à l'index"


if git diff --quiet && git diff --cached --quiet; then
    echo "➡️ Aucun changement à commiter (staging ou non)."
    exit 0
fi

COMMIT_MESSAGE="$1"

git commit -m "$COMMIT_MESSAGE"
echo "✅ Commit créé avec le message : \"$COMMIT_MESSAGE\""

git push
if [ $? -eq 0 ]; then
    echo "🎉 Push réussi !"
else
    echo "❌ Échec du push. Veuillez vérifier les erreurs ci-dessus."
fi