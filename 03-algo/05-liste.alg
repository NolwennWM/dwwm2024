<?xml version="1.0" encoding="UTF-8"?>
<Algo>
    <description texte="" courant="AFFICHER trucs[i]"/>
    <extension extnom="inactif"/>
    <fonction fctetat="inactif" fctcode=""/>
    <F2 F2para="" F2etat="inactif" F2defaut="" F2lignes=""/>
    <repere repetat="inactif" repcode="-10#10#-10#10#2#2"/>
    <param arrondiAuto="vrai" epaisseurLigne="2" totalBoucles="5000000" epaisseurPoint="2" maxBoucle="500000" totalAffichages="1000" nbDecimales="8"/>
    <item code="200#declarationfonctions" algoitem="FONCTIONS_UTILISEES"/>
    <item code="100#declarationsvariables" algoitem="VARIABLES">
        <item code="1#NOMBRE#i" algoitem="i EST_DU_TYPE NOMBRE"/>
        <item code="1#LISTE#trucs" algoitem="trucs EST_DU_TYPE LISTE"/>
    </item>
    <item code="101#debutalgo" algoitem="DEBUT_ALGORITHME">
        <item code="5#trucs#42#0" algoitem="trucs[0] PREND_LA_VALEUR 42"/>
        <item code="5#trucs#59#1" algoitem="trucs[1] PREND_LA_VALEUR 59"/>
        <item code="5#trucs#24#2" algoitem="trucs[2] PREND_LA_VALEUR 24"/>
        <item code="3#trucs#1#1" algoitem="AFFICHER trucs[1]"/>
        <item code="12#i#0#2" algoitem="POUR i ALLANT_DE 0 A 2">
            <item code="13#debutpour" algoitem="DEBUT_POUR"/>
            <item code="3#trucs#1#i" algoitem="AFFICHER trucs[i]"/>
            <item code="14#finpour" algoitem="FIN_POUR"/>
        </item>
    </item>
    <item code="102#finalgo" algoitem="FIN_ALGORITHME"/>
</Algo>
