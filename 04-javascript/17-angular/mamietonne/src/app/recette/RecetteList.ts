import {Recette, Types} from "./Recette";

export const RECETTES: Recette[] = [
    {
        id: 1,
        name: "Cannelé",
        type: Types.dessert,
        duration: 90,
        description: "Une délicieuse pâtisserie Bordelaise.",
        ingredients: [
            "250g de sucre", 
            "100 gfarine", 
            "4 oeuf", 
            "1 CàS de rhum", 
            "une ½ gousse de vanille",
            "un ½ litre de lait",
            "une pincé de sel",
            "60g de beurre"
        ],
        steps: [
            "Faire bouillir le lait avec la vanille et 50g de beurre.",
            "Dans un autre récipient mélanger la farine, le sucre, le sel, 2 oeufs et 2 jaunes d'oeufs.",
            "Verser le lait chaud et mélanger pour obtenir une pâte fluide.",
            "Ajouter le rhum, couvrir et placer au frais jusqu'à 24h.",
            "Verser au 3/4 dans des moules beurrés.",
            "Préchauffer le four à 200°C et cuire pendant 1h."
        ],
        image: "cannele.jpg",
        createdAt: new Date()
    },
    {
        id: 2,
        name: "Okonomiyaki",
        type: Types.dish,
        duration: 30,
        description: "Une galette au choux venu du Japon",
        ingredients: [
            "50ml d'eau", 
            "100g de farine", 
            "1 oeuf", 
            "80g de chou (chinois ou blanc)",
            "1 CàC de dashi",
            "Sauce à Okonomiyaki",
            "Mayonnaise",
            "Katsuoboshi",
            "6 fines tranches de lard"
        ],
        steps: [
            "Couper finement le chou.",
            "Mélanger ensemble farine, oeuf, dashi et eau.",
            "Ajouter le chou (et autre ingrédient bonus)",
            "Dans une poèle huilé et à feu moyen, déposer un rond de pâte.",
            "Après un certains temps retourner l'okonomiyaki et ajouter 3 tranches de lard.",
            "Retourner encore une fois pour cuire le lard.",
            "Au moment de servir recouvrir de trait de sauce à okonomiyaki et de mayonnaise puis soupoudrer de katsuoboshi."
        ],
        image: "okonomiyaki.jpg",
        createdAt: new Date()
    },
    {
        id: 3,
        name: "Carbonade Flamande",
        type: Types.dish,
        duration: 220,
        description: "Une spécialité de viande longuemant mijoté venant du Nord de la France",
        ingredients: [
            "1kg de boeuf", 
            "1L de bière brune", 
            "400g d'oignons", 
            "5 tranches de pain d'épice", 
            "3 CàS de moutarde",
            "30g de beurre",
            "1 CàS de cassonade",
            "1 bouquet garni",
            "250g de lard fumé",
            "sel"
        ],
        steps: [
            "Découper le boeuf en carré de 2 à 3 centimètres. Découper le lard en lardons. Découper les oignons grossièrement.",
            "Faire fondre le beurre pour faire suer les oignons et les ramollir.",
            "Ajouter le lard et remuer régulièrement tout en laissant couvert autant que possible.",
            "Retirer le tout sauf le jus et réserver pour plus tard.",
            "Mettre le boeuf et colorer tous les côtés à feu fort, puis retirer la viande et réserver là.",
            "Diluer la cassonade dans le jus de viande et laisser réduire pour obtenir un sirop.",
            "Mélanger le lard et l'oignon au sirop, puis le boeuf, ajouter le bouquet garni et recouvrir de bière. Saler très légèrement.",
            "Recouvrir de pain d'épice légèrement moutardé. Laisser mijoter 3h sans trop remuer pour que le pain d'épice fonde.",
            "Au bout de 2h retirer le bouquet garni et attendre que la sauce épaississe légèrement sans que cela ne brûle au fond."
        ],
        image: "carbonadeNL.jpg",
        createdAt: new Date()
    }
]