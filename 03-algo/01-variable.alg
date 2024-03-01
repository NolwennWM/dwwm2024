<?xml version="1.0" encoding="UTF-8"?>
<Algo>
    <description texte="" courant="AFFICHER mot"/>
    <extension extnom="inactif"/>
    <fonction fctetat="inactif" fctcode=""/>
    <F2 F2para="" F2etat="inactif" F2defaut="" F2lignes=""/>
    <repere repetat="inactif" repcode="-10#10#-10#10#2#2"/>
    <param arrondiAuto="vrai" epaisseurLigne="2" totalBoucles="5000000" epaisseurPoint="2" maxBoucle="500000" totalAffichages="1000" nbDecimales="8"/>
    <item code="200#declarationfonctions" algoitem="FONCTIONS_UTILISEES"/>
    <item code="100#declarationsvariables" algoitem="VARIABLES">
        <item code="1#CHAINE#mot" algoitem="mot EST_DU_TYPE CHAINE"/>
        <item code="1#CHAINE#mot2" algoitem="mot2 EST_DU_TYPE CHAINE"/>
    </item>
    <item code="101#debutalgo" algoitem="DEBUT_ALGORITHME">
        <item code="19#Je donne à ma variable &quot;mot&quot; la valeur &quot;ananas&quot;" algoitem="//Je donne à ma variable &quot;mot&quot; la valeur &quot;ananas&quot;"/>
        <item code="5#mot#&quot;Ananas&quot;#pasliste" algoitem="mot PREND_LA_VALEUR &quot;Ananas&quot;"/>
        <item code="3#mot#1#pasliste" algoitem="AFFICHER mot"/>
        <item code="19#Je demande une valeur à l'utilisateur que je rentre dans la variable &quot;mot2&quot;" algoitem="//Je demande une valeur à l'utilisateur que je rentre dans la variable &quot;mot2&quot;"/>
        <item code="2#mot2#pasliste" algoitem="LIRE mot2"/>
        <item code="4#J'aime la/le #0" algoitem="AFFICHER &quot;J'aime la/le &quot;"/>
        <item code="3#mot2#0#pasliste" algoitem="AFFICHER mot2"/>
        <item code="4# à l'#0" algoitem="AFFICHER &quot; à l'&quot;"/>
        <item code="3#mot#1#pasliste" algoitem="AFFICHER mot"/>
    </item>
    <item code="102#finalgo" algoitem="FIN_ALGORITHME"/>
</Algo>
