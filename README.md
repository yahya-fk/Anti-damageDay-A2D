
#
#
#
#
# <a name="_toc144137552"></a><a name="_toc144149830"></a>**ANTI-DAMAGE DAY**











# **TABLE DES MATIÈRES**
[ANTI-DAMAGE DAY	1](#_toc144149830)

[Installation Instructions: Anti-damageDay-A2D Project	4](#_toc144149831)

[Introduction	5](#_toc144149832)

[1.	Cahier des charges	5](#_toc144149833)

[1.1	Fonctionnalités Requises :	6](#_toc144149834)

[1.1.1	Collecte de Données :	6](#_toc144149835)

[1.1.2	Traitement et Validation :	6](#_toc144149836)

[1.1.3	Visualisation :	6](#_toc144149837)

[1.1.4	Niveaux de Détail :	6](#_toc144149838)

[1.1.5	Sécurité et Accès :	6](#_toc144149839)

[1.1.6	Évolutivité :	6](#_toc144149840)

[2.	Conception	7](#_toc144149841)

[2.1	DIAGRAMME DE CLASSE	7](#_toc144149842)

[2.2	DIAGRAMME DE CAS D’UTILISATION	8](#_toc144149843)

[2.3	DIAGRAMMES DE SEQUENCE	9](#_toc144149844)

[2.3.1	DS CREATION DE COMPTE	9](#_toc144149845)

[2.3.2	DS LOG IN	9](#_toc144149846)

[2.3.3	DS Page AUDIT	10](#_toc144149847)

[2.3.4	DS Gestion des AUDITS	10](#_toc144149848)

[2.3.5	DS Gestion des QUESTIONS	11](#_toc144149849)

[N.B	11](#_toc144149850)

[3.	realisation	11](#_toc144149851)

[3.1	Environnement de Développement	12](#_toc144149852)

[3.2	Développement du Partie utilisateur normale	12](#_toc144149853)

[3.2.1	Création du compte et Log in	12](#_toc144149854)

[3.2.2	Page Principale	14](#_toc144149855)

[3.2.3	Page Audit	16](#_toc144149856)

[3.2.4	Page Tableau de Bord	21](#_toc144149857)

[3.2.5	Pages planning, Concept, Paramètre, Tutoriel	23](#_toc144149858)

[3.3	Développement du Partie utilisateur admin	25](#_toc144149859)

[3.3.1	La Page Principale	25](#_toc144149860)

[3.3.2	La Page User	26](#_toc144149861)

[3.3.3	La Page Question	28](#_toc144149862)

[3.3.4	La page Planning	30](#_toc144149863)

[3.3.5	La page Audit	31](#_toc144149864)

[4.	Conclusion	33](#_toc144149865)

[5.	Anti-damage day version demo	33](#_toc144149866)

[Conclusion génerale	34](#_toc144149867)



4**

Chapitre 2 : Contexte général du projet Anti-Damage Day

# <a name="_toc144137553"></a><a name="_toc144149831"></a>**INSTALLATION INSTRUCTIONS: ANTI-DAMAGEDAY-A2D PROJECT**
These instructions will guide you through setting up the Anti-damageDay-A2D project on your local machine using XAMPP or Laragon.

1. ` `Install XAMPP or Laragon:
- Install XAMPP or Laragon on your computer. You can download XAMPP from the official website (https://www.apachefriends.org/index.html) or Laragon from its website (https://laragon.org/download/).
1. ` `Start Apache and MySQL:
- Open the XAMPP Control Panel and start both the Apache and MySQL services.
1. Download or Clone the Project:
- **Option 1**: Download the project directly from GitHub.

Visit the project repository on GitHub: https://github.com/YaHyA-FK/Anti-damageDay-A2D.git

Click the "Code" button and select "Download ZIP."

Extract the downloaded ZIP file to a location of your choice.

- **Option 2**: Clone the project using Git Bash.

Open Git Bash.

Navigate to the directory where you want to store the project using the cd command. For example: cd C:\Laragon\www\

Run the following command to clone the project:

bashCopy code

git clone https://github.com/YaHyA-FK/Anti-damageDay-A2D.git 

1. Load the Database:
- Open the database management tool provided by XAMPP or Laragon.
- Find the "Import" or "Load SQL File" option.
- Navigate to the project directory you downloaded or cloned (Anti-damageDay-A2D) and find the antidamageday.sql file.
- Select the antidamageday.sql file to import the database structure and data.
1. ` `Access the Project:
- Open any web browser.
- In the address bar, type: http://localhost/Anti-damageDay-A2D
- You will be directed to the project's homepage.
1. Register and Login:
- Click on the appropriate links to register a new account if you don't have one, or login if you already have an account.
- Now you're all set to explore the Anti-damageDay-A2D project on your local machine!
- Please note that the exact steps might vary slightly based on your operating system and the software versions you're using.
# <a name="_toc144149832"></a>**INTRODUCTION**
L'essor de la technologie a considérablement transformé la manière dont les entreprises mènent leurs opérations et leurs processus internes. Parmi ces évolutions, l'informatisation des audits a émergé comme une initiative visant à améliorer l'efficacité, la précision et la traçabilité de l'évaluation des performances organisationnelles. Cependant, avec cette transition vers l'automatisation des audits, surgissent une série de défis complexes qui nécessitent une attention minutieuse. Cette étude se penche sur l'élaboration d'une application novatrice visant à collecter, traiter et visualiser les données d'audit de manière méthodique, tout en offrant une perspective allant de l'ensemble global de données jusqu'aux détails les plus spécifiques au moyen de diagrammes perspicaces. Dans ce contexte, cette APP explore les défis essentiels liés à la fiabilité des données collectées, à la sécurité des informations sensibles, à la variété des sources de données et à l'évolutivité de l'application, dans le but de parvenir à une solution complète et performante pour l'informatisation d'audit.
1. # <a name="_toc144137554"></a><a name="_toc144149833"></a>**CAHIER DES CHARGES** 
Concevoir une application d'automatisation d'audit qui collecte, traite et visualise les données d'audit de manière efficace, en garantissant la fiabilité des données collectées tout en offrant une transition transparente de la représentation des données du niveau général au niveau particulier dans des diagrammes informatifs, tout en gérant les défis liés à la variété des sources de données, à la sécurité des informations sensibles et à l'évolutivité de l'application et aussi L’application doit être accessible par QR code , à tous les collaborateurs Stellantis Kenitra par leur ID.
1. ## <a name="_toc144137555"></a><a name="_toc144149834"></a>**Fonctionnalités Requises :**
   1. ### <a name="_toc144137556"></a><a name="_toc144149835"></a>**Collecte de Données :**
- L'application devra être capable de collecter des données d'audit à partir de différentes sources, y compris des systèmes internes et externes.
- La collecte de données doit être automatisée et planifiable, permettant une mise à jour régulière des informations.
  1. ### <a name="_toc144137557"></a><a name="_toc144149836"></a>**Traitement et Validation :**
- Les données collectées devront être traitées pour garantir leur cohérence et leur intégrité.
- Des mécanismes de validation doivent être mis en place pour détecter et signaler les erreurs ou les incohérences dans les données.
  1. ### <a name="_toc144137558"></a><a name="_toc144149837"></a>**Visualisation :**
- L'application doit offrir des fonctionnalités de visualisation pour représenter les données d'audit de manière informative.
- Des diagrammes et graphiques pertinents seront utilisés pour permettre une compréhension aisée des tendances et des résultats d'audit.
  1. ### <a name="_toc144137559"></a><a name="_toc144149838"></a>**Niveaux de Détail :**
- L'application devra permettre aux utilisateurs de passer en douceur du niveau global de données au niveau détaillé, en mettant en évidence les informations pertinentes.
  1. ### <a name="_toc144137560"></a><a name="_toc144149839"></a>**Sécurité et Accès :**
- Les données sensibles doivent être stockées et transmises de manière sécurisée, conformément aux normes de sécurité en vigueur.
- L'accès à l'application sera géré par un système d'authentification basé sur l'ID du collaborateur Stellantis Kenitra, avec une option d'accès via QR code.
  1. ### <a name="_toc144137561"></a><a name="_toc144149840"></a>**Évolutivité :**
- L'architecture de l'application doit être conçue pour permettre une évolutivité aisée en cas d'ajout de nouvelles fonctionnalités ou de gestion d'un volume croissant de données.
1. # <a name="_toc144137562"></a><a name="_toc144149841"></a>**CONCEPTION**
Pour répondre à ces besoins, nous avons envisagé de réaliser les diagrammes suivant, en utilisant UML.



1. ## <a name="_toc144137563"></a><a name="_toc144149842"></a>**DIAGRAMME DE CLASSE** 
(readme/Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.001.png)

<a name="_toc144130668"></a>**Figure 45 diagramme de classe du A2D**
1. ## <a name="_toc144137564"></a><a name="_toc144149843"></a>**DIAGRAMME DE CAS D’UTILISATION**
![Screenshot 2023-08-24 165123](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.002.png)

<a name="_toc144130669"></a>**Figure 46 Diagramme de cas d'utilisation du A2D**

Chapitre 2 : Contexte général du projet Anti-Damage Day


1. ## <a name="_toc144137565"></a><a name="_toc144149844"></a>**DIAGRAMMES DE SEQUENCE**
   1. ### <a name="_toc144137566"></a><a name="_toc144149845"></a>**DS CREATION DE COMPTE**
(readme/Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.003.png)

<a name="_toc144130670"></a>**Figure 47 DS création du compte A2D**
1. ### <a name="_toc144137567"></a><a name="_toc144149846"></a>**DS LOG IN**
![C:\Users\se39040\AppData\Local\Microsoft\Windows\INetCache\Content.Word\Screenshot 2023-08-24 153159.png](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.004.png)

<a name="_toc144130671"></a>**Figure 48 DS log in A2D**
1. ### <a name="_toc144137568"></a><a name="_toc144149847"></a>**DS Page AUDIT**
![Screenshot 2023-08-24 153820](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.005.png)

<a name="_toc144130672"></a>**Figure 49 DS PAGE AUDIT**
1. ### <a name="_toc144137569"></a><a name="_toc144149848"></a>**DS Gestion des AUDITS**
![Screenshot 2023-08-27 123520](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.006.png)

<a name="_toc144130673"></a>**Figure 50 DS Gestion des audits  A2D**
1. ### <a name="_toc144137570"></a><a name="_toc144149849"></a>**DS Gestion des QUESTIONS**
![Screenshot 2023-08-27 125045](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.007.png)

<a name="_toc144130674"></a>**Figure 51 DS Gestion des QUESTIONS A2D**
### <a name="_toc144137571"></a><a name="_toc144149850"></a>**N.B**
Outre les fonctionnalités principales décrites précédemment, d'autres fonctions ont été mises en place pour compléter l'application. Celles-ci partagent des étapes similaires avec les fonctions déjà discutées ou présentent des processus qui ne nécessitent pas d'explication détaillée. Ces fonctions incluent (Gestion des utilisateurs, Gestion des planning, Page tableau de bord, Page Menu, Page Paramètre, Page Planning, Page Concept, Log out).
1. # <a name="_toc144137572"></a><a name="_toc144149851"></a>**REALISATION**
Après avoir finalisé la phase de conception, nous sommes passés à la réalisation de l'application en suivant les spécifications et les maquettes établies dans la phase précédente. Cette étape consiste à transformer les concepts abstraits en une application fonctionnelle en utilisant les technologies et les outils appropriés.



1. ## <a name="_toc144137573"></a><a name="_toc144149852"></a>**Environnement de Développement**
L'environnement de développement choisi pour la réalisation de l'application était le suivant:

- Langage de programmation : JavaScript ,HTML,CSS,BOOSTRAP,PHP
- Base de données : MYSQL
- Outils de développement : Visual Studio Code, Git, Laragon, AdobePhotoshop

![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.008.png)![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.009.png)![C:\Users\se39040\Downloads\ri32-logo-laragon.png](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.010.png)![C:\Users\se39040\Downloads\download (1).png](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.011.png)![C:\Users\se39040\Downloads\visual-studio-code7642.jpg](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.012.jpeg)

<a name="_toc144130675"></a>**Figure 52 Les outils utilisées**

1. ## <a name="_toc144137574"></a><a name="_toc144149853"></a>**Développement du Partie utilisateur normale**
   1. ### <a name="_toc144137575"></a><a name="_toc144149854"></a>**Création du compte et Log in**
      1. #### **Développement du Front-end**
Dans le cadre du développement du front-end de l'application, nous avons adopté une approche visuelle engageante pour captiver les utilisateurs et transmettre un message émotionnel fort. Pour cela, nous avons utilisé les éléments suivants :

- **Templates Bootstrap** : Nous avons choisi d'utiliser des templates Bootstrap pour la mise en page et le design de l'interface utilisateur. Ces templates offrent une base solide pour la création de pages esthétiques et réactives, garantissant une expérience utilisateur cohérente sur différents appareils.
- **Édition d'Images avec Adobe Photoshop** : Pour renforcer l'impact visuel, nous avons utilisé Adobe Photoshop pour créer une image principale captivante. Cette image a été soigneusement éditée en incorporant des dégradations subtiles sur le véhicule. En outre, nous avons ajouté des éléments symboliques tels que des cicatrices pour transmettre le message que le véhicule, tout comme un être humain, peut porter des traces de son histoire et de son vécu.

![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.013.png)

<a name="_toc144130676"></a>**Figure 53 photo principale de A2D**

- **Utilisation de la Symbolique** : L'ajout de cicatrices et de dégradations sur l'image vise à rappeler aux utilisateurs que même après des réparations et des améliorations, le véhicule peut garder des marques visibles de son parcours. Cette symbolique vise à susciter une connexion émotionnelle, encourageant les utilisateurs à percevoir le véhicule comme un être vivant avec son propre récit.
- **Utilisation du Son** : En plus des éléments visuels, nous avons également intégré des éléments audio subtils pour renforcer l'expérience utilisateur. Des sons apaisants et rythmés ont été inclus pour créer une ambiance qui invite les utilisateurs à réfléchir et à se connecter à la symbolique de l'image.
  1. #### **Développement du Back-end**
Dans la phase de développement du back-end, notre objectif était de créer une infrastructure robuste pour gérer les données, assurer la sécurité de l'authentification et offrir une expérience utilisateur fluide. Voici les principales fonctionnalités que nous avons mises en œuvre :


- **Gestion des Données** : Nous avons conçu et mis en place une base de données MySQL pour stocker les informations liées aux utilisateurs, aux véhicules et aux données d'audit. Les données sont organisées de manière à permettre une récupération efficace et sécurisée lorsque nécessaire.
- **Authentification et Sessions** : Lorsqu'un utilisateur se connecte, nous utilisons PHP pour vérifier les informations d'identification fournies. Si les informations sont valides, nous créons une session sécurisée qui permet à l'utilisateur d'accéder à différentes parties de l'application en toute sécurité. Cette session garantit que l'utilisateur reste connecté et peut accéder à ses données sans avoir à se reconnecter fréquemment.

session\_start();

$\_SESSION["id"] = $id;

$\_SESSION['nom'] = $name;

$\_SESSION['pnom'] = $fname;

- **Validation des Données** : Avant d'insérer ou de mettre à jour des données dans la base de données, nous effectuons des vérifications rigoureuses pour garantir l'intégrité des données. Les données reçues sont validées et filtrées pour éviter les failles de sécurité telles que les injections SQL.
  1. #### **Captures d'écran des interfaces**
![C:\Users\se39040\AppData\Local\Microsoft\Windows\INetCache\Content.Word\Screenshot 2023-08-24 174135.png](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.014.png)![Screenshot 2023-08-24 173909](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.015.png)

<a name="_toc144130677"></a>**Figure 54 capture d'écran de page login et création du compte A2D**
1. ### <a name="_toc144137576"></a><a name="_toc144149855"></a>**Page Principale**
   1. #### **Développement du Front-end**
Pour la conception du front-end de la page principale, nous avons choisi une approche conviviale et intuitive pour faciliter la navigation et offrir une expérience utilisateur agréable. Voici comment nous avons conçu cette section :

- **Barre de Navigation (Navbar)** : La première chose que les utilisateurs verront en accédant à la page principale est une barre de navigation en haut de la page. Cette barre de navigation contient le logo de **Stellantis**, qui renforce la cohérence visuelle avec la marque, ainsi que le nom d'utilisateur connecté. Elle inclut également un bouton de déconnexion, permettant aux utilisateurs de se déconnecter rapidement et en toute sécurité.
- **Présentation des Interfaces** : La majeure partie de la page est consacrée à la présentation des différentes interfaces de l'application sous forme de cartes (cards). Chaque carte représente une interface distincte de l'application.
- **Image** : Chaque carte comporte une image symbolique représentant visuellement le contenu de l'interface. Cette image a été soigneusement sélectionnée pour communiquer l'essence de chaque interface de manière graphique.
- **Titre** : Chaque carte est également dotée d'un titre significatif qui décrit l'interface correspondante.
- **Bouton d'Accès** : Chaque carte est associée à un bouton permettant aux utilisateurs de basculer rapidement vers l'interface respective en cliquant dessus.
  1. #### **Développement du Back-end**
Pour la gestion de la page de menu, nous avons mis en place une logique côté serveur pour assurer une navigation sécurisée et la validation des données. Voici comment nous avons abordé cette section :

- **Vérification de Session** : Lorsqu'un utilisateur accède à la page de menu, le back-end vérifie d'abord si une session est active. Si l'utilisateur n'est pas connecté, il est automatiquement redirigé vers la page de connexion pour garantir l'accès sécurisé aux fonctionnalités.

`  `session\_start();

`  `$user=$\_SESSION['id'];

`  `$nom=$\_SESSION['nom'];

`  `$pnom=$\_SESSION['pnom'];

- **Partie liée à l'Audit** : Une partie spécifique de la page de menu est dédiée à la fonctionnalité d'audit. Nous avons mis en place une logique pour vérifier si une variable appelée "data" est transmise à la page via la méthode GET. Si cette variable existe, la page affiche un message de confirmation, indiquant que les données ont été sauvegardées avec succès.

`          `<?php

`           `if (isset($\_GET['data'])) {

`            `echo"<p class='text-success'>Les données sont bien sauvegardées</p>";

`           `}

`          `?>
1. #### ![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.016.png)**Capture d'écran de l’interface**










<a name="_toc144130678"></a>**Figure 55 Capture d'écran Page MENU A2D**
![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.017.png)
1. ### <a name="_toc144137577"></a><a name="_toc144149856"></a>**Page Audit**
   1. #### **Développement du Front-end**
      1. ##### **Interface Page Audit**
La page Audit se compose d'une interface utilisateur interactive conçue pour capturer les informations d'audit. Voici comment nous avons structuré cette interface :

- **Barre de Navigation (Navbar)** : Comme indiqué précédemment, la barre de navigation en haut de la page facilite la navigation entre les différentes parties de l'application.
- **Formulaire d'Audit** : Au centre de la page, nous avons intégré un formulaire permettant aux utilisateurs de saisir les informations d'audit. Ce formulaire comprend divers champs et options qui sont nécessaires pour l'enregistrement des données d'audit.
- **Redirection vers l'Interface Questionnaire** : Une fois que l'utilisateur a rempli le formulaire d'audit et a confirmé les données, la page redirige automatiquement l'utilisateur vers l'interface du questionnaire.
  1. ##### **Interface Questionnaire**
L'interface Questionnaire est conçue pour recueillir des réponses à cinq types de questions différents tout en maintenant la flexibilité pour l'auditeur. Voici comment cette partie a été mise en place :

- **Barre de Navigation (Navbar)** : contient un button pour annuler l’audit
- **Cartes de Confirmation** : En haut de la page, des cartes sont affichées, présentant un résumé des données saisies dans le formulaire d'audit. Les utilisateurs peuvent les vérifier.
- **Boutons de Navigation Verticale** : Juste en dessous des cartes, cinq boutons disposés verticalement sont présents. Chaque bouton est accompagné d'une icône personnalisée représentant le type de question associé.
- **Navigation entre les Questions** : Lorsque l'utilisateur clique sur l'un des boutons, la page affiche les questions correspondantes à ce type. Cela permet à l'auditeur de passer d'une question à l'autre sans perdre les données déjà saisies.
  1. #### **Développement du Back-end**
     1. ##### **Interface Page Audit**
La gestion de l'interface d'audit implique une interaction fluide entre les sélections de l'utilisateur et les données à afficher. Voici comment nous avons conçu cette logique pour optimiser l'expérience utilisateur :

- **Gestion des Sélections en Temps Réel** : Nous avons implémenté une fonction JavaScript qui s'exécute à chaque changement dans les éléments select (menus déroulants). Lorsqu'un utilisateur sélectionne une option, la valeur sélectionnée est capturée instantanément.

- **Envoi de la Sélection vers la Page d'Action** : Une fois la sélection capturée, nous envoyons cette valeur vers une page d'action spécifique dédiée au traitement. Cette page d'action utilise la valeur pour déterminer les options à afficher dans le prochain élément select en se basant sur la relation entre les données.

function ValueSender(){

`  `let idZ=document.getElementById('Zone').value;

`  `let id=document.getElementById('Atelier').value;

`    `if(id>0 && idZ>0){

`    `location.href="auditpageaction.php?id="+id+"&idZ="+idZ;}

}

- **Construction et Envoi des Données au Format JSON** : La page d'action crée une liste d'options appropriées en utilisant des données stockées dans des tableaux JavaScript. Ensuite, nous utilisons JSON.stringify pour convertir cette liste en une variable JSON et la renvoyons à la page d'audit à l'aide de la méthode GET.

<script>

`       `<?php

`            `echo"var tab=[";

`            `$c=0;

`        `foreach ($stmt as $row){

`            `echo "{id:" . $row["id\_Z"]. ",nom:'" .$row["zone"]."',idAtelier:".$row["id\_Atelier"]."},";

`    `}

`        `echo"]\n";

?>

let myjson=JSON.stringify(tab)

- **Traitement des Données sur la Page d'Audit** : La page d'audit reçoit la variable JSON et la traite pour afficher les options dans le prochain élément select. Cette approche permet de maintenir la flexibilité et la fluidité de l'expérience utilisateur tout en évitant de recharger la page.

` `if(isset($\_GET['id'])){

`        `$id=$\_GET['id'];

`    `echo"const Tab=JSON.parse('$id')\n";



?>

`    `let html=""

`    `Tab.forEach(e => {

`    `html+="<option value="+e.id+">"+e.nom+"</option>"

`    `});

`    `document.getElementById("Zone").innerHTML+=html;

`    `document.getElementById("Atelier").value=Tab[0].idAtelier

Ce processus est répété pour chaque niveau de sélection dans les éléments select tels que "**Atelier**," "**Module**," "**UEP**," et "**Poste**".
1. ##### **Interface Page Questionnaire**
L'interface du questionnaire constitue une partie cruciale de l'application, permettant aux utilisateurs de remplir les réponses et de sauvegarder les données de l'audit. Voici comment nous avons structuré cette interface pour garantir une expérience fluide et sécurisée :

- **Génération de l'ID d'Audit** : Dès l'ouverture de la page questionnaire, un identifiant unique est généré en utilisant la date et l'heure de création de l'audit. Cet identifiant prend la forme "audit170720231023," fournissant une référence unique pour chaque audit.

`  `$timestamp = date('dmYHi');

`  `$auditId = 'audit' . $timestamp;

- **Sauvegarde Préliminaire de l'Audit** : En cas d'annulation de l'audit via le bouton "Annuler Audit," l'application supprime l'audit de la base de données. Cette approche garantit que seuls les audits complets sont conservés dans la base de données, évitant ainsi les enregistrements inutiles.
- **Création de la Session audit** : Une fois que l'audit est sauvegardé, l'application crée une session appelée audit qui est égale à l'ID de l'audit en cours. Cette session permet de suivre l'état de l'audit même lors de la navigation ou du rafraîchissement de la page.
- **Gestion de la Session lors de la Navigation** : Pour éviter la présence d'audits incomplets dans la base de données, l'application vérifie la session audit lors de chaque changement de page ou de rafraîchissement. Si la session est active, l'audit associé est supprimé de la base de données.

` `$sql="Delete from audit where id\_A = ?";

`        `$stmt\_insert = $conn->prepare($sql);

`        `$stmt\_insert->bindParam(1, $\_SESSION["Audit"]);

`        `$stmt\_insert->execute();

`        `header("Location: menupage.php");

`        `exit;

- **Remplissage des Questions de l'Audit** : Une fois la gestion préliminaire effectuée, l'utilisateur peut commencer à remplir les questions liées à l'audit. Les questions sont récupérées à partir de la base de données et affichées pour que l'utilisateur puisse y répondre.
- **Sauvegarde des Réponses** : Lorsque l'utilisateur termine de remplir les questions, l'application sauvegarde ces réponses dans la base de données, associées à l'identifiant unique de l'audit.

for($i = 1; $i <= $nbr; $i++){

`            `$id = $\_SESSION['Audit'];

`            `$var1 = "cmnt$i";

`            `$var1 = $\_POST[$var1];

`            `if($i == 20){

`                `InsertAnswertData($conn, NULL, $var1, $i, $id);

`                `continue;

`            `}

`            `else{

`                `$var = "qst$i";

`                `$var = $\_POST[$var];

`            `}

`            `InsertAnswertData($conn, $var, $var1, $i, $id);

`        `}

Cette approche garantit que seuls les audits complets sont stockés dans la base de données et que les données sont gérées en toute sécurité. Elle permet également aux utilisateurs de reprendre là où ils se sont arrêtés en cas de changement de page ou de rafraîchissement, améliorant ainsi l'expérience utilisateur.


1. #### ![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.018.png)**Captures d'écran des interfaces**	

![Screenshot 2023-08-25 135235](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.019.png)

<a name="_toc144130679"></a>**Figure 56 Captures d'écran des interfaces Audit et Questionnaire A2D**

![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.020.png)

1. ### <a name="_toc144137578"></a><a name="_toc144149857"></a>**Page Tableau de Bord**
   1. #### **Développement du Front-end**
Le tableau de bord joue un rôle essentiel en offrant aux utilisateurs un aperçu complet des données d'audit. Voici comment nous avons conçu cette section pour fournir une vue globale et des analyses détaillées :

- **Sélection de Mois et Années** : Au-dessus de la page du tableau de bord, deux menus déroulants permettent à l'utilisateur de sélectionner le mois et l'année qu'il souhaite analyser.
- **Graphiques Globaux de Pourcentage des NOK** : En fonction de la sélection de mois et d'années, la page affiche un graphe global illustrant le pourcentage de NOK pour chaque atelier de l'usine. Cela offre une vue instantanée de la performance générale.
- **Filtres Spécifiques** : Juste en dessous du graphe, des cases à cocher permettent à l'utilisateur de choisir des graphiques spécifiques à afficher. En cliquant sur "Filtrer," l'utilisateur est redirigé vers des pages distinctes avec des graphiques spécifiques.
- **Graphes par Atelier et Module** : La page "tbpage 2" présente quatre graphiques, chacun montrant le pourcentage de NOK pour chaque module des quatre ateliers de l'usine.
- **Graphes par UEP** : La page "tbpage 3" offre une vue encore plus détaillée en présentant le pourcentage de NOK pour chaque UEP de chaque module.
- **Répétition pour les Postes**: Le même modèle est répété pour afficher les pourcentages de NOK pour chaque poste dans des pages distinctes.
- **Répétition pour les 5M**: Le même modèle est répété pour afficher les pourcentages de NOK pour chaque (Méthode, Matière, Machine, Main-d'œuvre, Milieu) dans des pages distinctes.

Cette approche offre une vue globale ainsi que des analyses détaillées pour aider les utilisateurs à comprendre la performance de l'usine dans différents contextes.
1. #### **Développement du Back-end**
Le back-end des interfaces du tableau de bord englobe la gestion des sessions et le transfert efficace des données vers le front-end pour affichage sous forme de tableau ou de graphique. Voici comment nous avons mis en place cette logique :

- **Gestion des Sessions** : Tout comme dans les autres parties de l'application, nous utilisons la gestion de sessions pour suivre les états et les données des utilisateurs pendant leur navigation. Cela garantit que les données restent cohérentes et sécurisées, même en cas de rafraîchissement ou de changement de page.
- **Transfert des Données vers le Front-End** : Lorsque l'utilisateur sélectionne un mois et une année spécifiques, le back-end collecte les données pertinentes à partir de la base de données en fonction de ces paramètres. Ces données sont ensuite formatées pour être envoyées au front-end.

function chartByAtelier($conn,$M,$Y){

`  `$sql = "SELECT atelier.atelier AS Atelier,  

`  `(SUM(IF(reponse.reponse = 'NOK', 1, 0)) / COUNT(\*)) \* 100 AS NOKPercentage

`  `FROM audit

`  `JOIN poste ON audit.id\_Poste = poste.id\_P

`  `JOIN module ON poste.id\_M = module.id\_M

`  `JOIN zone ON module.id\_Z = zone.id\_Z

`  `JOIN atelier ON atelier.id = zone.id\_Atelier

`  `JOIN reponse ON reponse.id\_A = audit.id\_A

`  `WHERE Reponse NOT LIKE 'NA' and MONTH(date) = ? and YEAR(date)= ?

`  `GROUP BY atelier.atelier";

`  `$stmt = $conn->prepare($sql);

`  `$stmt->bindParam(1, $M);

`  `$stmt->bindParam(2, $Y);

`  `$stmt->execute();

`  `$results = $stmt->fetchAll(PDO::FETCH\_ASSOC);

`  `return $results;

}

- **Affichage des Données** : En fonction du choix de l'utilisateur (tableau ou graphique), les données sont traitées en conséquence :
  - **Tableau** : Si l'utilisateur choisit d'afficher les données sous forme de tableau, le backend envoie les données formatées sous forme de tableaux multidimensionnels au frontend. Le frontend utilise ces données pour générer un tableau structuré et informatif.
  - **Graphique avec Chart.js** : Si l'utilisateur opte pour un affichage graphique, le backend envoie les données au format compatible avec la bibliothèque Chart.js, qui est utilisée pour générer des graphiques interactifs. Les données sont structurées pour que Chart.js puisse créer des graphiques visuellement attrayants et significatifs.

En utilisant cette approche, nous permettons aux utilisateurs de visualiser et d'analyser les données selon leurs préférences, qu'il s'agisse d'une présentation tabulaire ou graphique.
1. #### **Captures d'écran des interfaces**
<a name="_toc144130680"></a>**Figure 57 Captures d'écran des interfaces de Tableau de bord**

<a name="_toc144130681"></a>**Figure 58 Capture d'écran des interfaces de Tutoriel Page A2D**
![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.021.png)![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.022.png)![](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.023.png)










1. ### <a name="_toc144137579"></a><a name="_toc144149858"></a>**Pages planning, Concept, Paramètre, Tutoriel**
Dans cette section, nous abordons le développement front-end et back-end de quatre pages distinctes : "Planning," "Concept," "Paramètre," et "Tutoriel." Chacune de ces pages sert un objectif spécifique au sein de l'application. 
1. #### **Développement du Front-End**
- **Planning** : La page "Planning" présente une vue concise des deux mois et met en évidence les jours d'audit en rouge. Pour réaliser cela, nous avons conçu une interface simple avec une barre de navigation (navbar) pour la navigation facilitée. Cette page affiche le planning des audits pour les prochains mois, mettant en évidence les jours d'audit.
- **Tutoriel** : La page "Tutoriel" offre des ressources d'apprentissage sous forme de vidéos. Nous avons intégré des vidéos YouTube à l'aide de balises iframe pour permettre aux utilisateurs de visualiser et de suivre des instructions détaillées sur l'utilisation de l'application. Cette page présente également du texte descriptif pour accompagner les vidéos.
- **Paramètre** : La page "Paramètre" comprend un formulaire permettant aux utilisateurs de modifier leurs informations personnelles et leur mot de passe. Le formulaire demande le nom, le prénom, l'ancien mot de passe, le nouveau mot de passe et la confirmation du nouveau mot de passe. Une barre de navigation reste également présente pour une navigation cohérente.
  1. #### **Développement du Back-End**
- **Planning** : Le back-end de la page "Planning" récupère les données nécessaires depuis la base de données. Il identifie les jours où des audits sont programmés et marque ces jours dans le calendrier de l'interface front-end. Cette opération assure que les utilisateurs ont une vue claire des jours d'audit à venir.
- **Paramètre** : Concernant la page "Paramètre," le back-end est responsable de prendre les données modifiées du formulaire et de les envoyer à la base de données pour mise à jour. Cela garantit que les modifications apportées par les utilisateurs sont correctement enregistrées dans le système.

` `if ($newPassword !== $cpwsd) {

`            `echo "Error: New password and confirm password do not match.";

`            `exit;}

`            `$stmt = $conn->prepare("SELECT password FROM personne WHERE id\_P = :id");

`            `$stmt->bindParam(':id', $id);

`            `$stmt->execute();

`            `$result = $stmt->fetch(PDO::FETCH\_ASSOC);

`            `if ($result) {

`                `$hashedPassword = $result['password'];

`                `if (password\_verify($oldPassword, $hashedPassword)) {

`                    `$hashedNewPassword = password\_hash($newPassword, PASSWORD\_DEFAULT);

`                    `$stmt = $conn->prepare("UPDATE personne SET password = :password WHERE id\_P = :id");

`                    `$stmt->bindParam(':password', $hashedNewPassword);

`                    `$stmt->bindParam(':id', $id);

`                    `$stmt->execute();

`                `} else {

`                    `echo "Error: Old password is incorrect.";

`                `}

`            `} else {

`                `echo "Error: User not found.";

`            `}

1. #### **Captures d'écran des interfaces**
![Screenshot 2023-08-27 194003](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.024.png)![Screenshot 2023-08-27 194034](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.025.png)

![Screenshot 2023-08-27 194059](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.026.png)![Screenshot 2023-08-27 194135](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.027.png)

<a name="_toc144130682"></a>**Figure 59 Captures d'écran des interfaces Planning Concept Paramètre tuto A2D**
1. ## <a name="_toc144137580"></a><a name="_toc144149859"></a>**Développement du Partie utilisateur admin**
Dans cette section, nous nous penchons sur le développement de l'interface utilisateur pour l'administrateur. 
1. ### <a name="_toc144137581"></a><a name="_toc144149860"></a>**La Page Principale**
La page principale destinée aux administrateurs constitue le cœur du panneau de contrôle. Elle offre une expérience conviviale pour la gestion des différentes sections de l'application. Voici comment nous avons conçu cette page :
1. #### **Front-End :**
- **Navbar et Sidebar** : L'interface de la page principale se compose d'une barre de navigation (navbar) et d'une barre latérale (sidebar). Le sidebar offre une navigation rapide avec des boutons pour accéder à toutes les autres pages du panneau de contrôle, notamment "Utilisateurs," "Questions," "Audits," et "Planning."
- **Sidebar Rétractable** : La sidebar est rétractable et peut être affichée ou masquée à l'aide du bouton "Menu." Cela permet aux administrateurs de maximiser l'espace d'affichage lorsqu'ils en ont besoin.
  1. #### **Back-End :**
Le back-end de la page principale est principalement responsable de la gestion de la navigation et des informations d'utilisateur :

- **Navigation Facilitée** : Le back-end facilite la navigation en gérant les redirections vers les différentes sections du panneau de contrôle. Lorsque l'administrateur clique sur un bouton de navigation, le back-end assure une transition fluide vers la page correspondante.
- **Affichage de l'Utilisateur Connecté** : La section du compte de l'utilisateur est également gérée par le back-end. Lorsque l'administrateur clique sur le bouton "Account," les informations pertinentes telles que l'identifiant et le nom d'utilisateur sont affichées. Un bouton de déconnexion permet également à l'utilisateur de se déconnecter rapidement et en toute sécurité.

La page principale offre une expérience utilisateur intuitive et facilite la navigation et la gestion pour les administrateurs. En intégrant le front-end et le back-end de manière transparente, nous assurons une interaction fluide avec l'ensemble du panneau de contrôle.
1. #### **Capture d’écran de l’interface**
![Screenshot 2023-08-27 200152](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.028.png)

<a name="_toc144130683"></a>**Figure 60 capture d'écran de la page principale Admin A2D**
1. ### <a name="_toc144137582"></a><a name="_toc144149861"></a>**La Page User**
La page "Utilisateur" est essentielle pour la gestion des comptes utilisateur par les administrateurs. Cette page offre un moyen convivial de gérer les utilisateurs enregistrés dans l'application.
1. #### **Front-End :**
- **Navbar et Sidebar** : Comme les autres pages principales de l'application, la page "Utilisateur" dispose d'une barre de navigation (navbar) et d'une barre latérale (sidebar) pour une navigation facile. Cela assure une cohérence visuelle et facilite l'accès aux différentes pages du panneau de contrôle.
- **Tableau des Utilisateurs** : Le cœur de cette page est un tableau affichant les utilisateurs enregistrés dans la base de données. Chaque ligne du tableau présente les informations essentielles sur un utilisateur, ainsi que deux boutons : l'un pour accéder à la page de modification de l'utilisateur et l'autre pour supprimer l'utilisateur.
  1. #### **Back-End :**
Le back-end de la page "Utilisateur" se charge de gérer les interactions avec les comptes utilisateur :

- **Suppression d'Utilisateur** : Lorsqu'un administrateur clique sur le bouton "Supprimer" associé à un utilisateur, le back-end supprime cet utilisateur de la base de données. Suite à cette action, l'administrateur est redirigé vers la page principale avec un message de succès indiquant que la suppression a été effectuée avec succès.

` `$sql="DELETE FROM personne WHERE id\_P = ?";

`    `$stmt=$conn->prepare($sql);

`    `$stmt->bindParam(1,$\_GET['id\_p']);

`    `$stmt->execute();

`    `header("location: main.php?success=User has been deleted");

`    `exit;

- **Modification d'Utilisateur** : Si l'administrateur clique sur le bouton "Modifier" associé à un utilisateur, il est redirigé vers une page de modification dédiée. Cette page contient un formulaire pré-rempli avec les informations actuelles de l'utilisateur. L'administrateur peut apporter des modifications aux informations autres que l'ID (qui n'est pas modifiable). Le mot de passe n'est pas affiché dans le formulaire, pour des raisons de sécurité. Si des modifications sont apportées, l'administrateur peut soit soumettre le formulaire pour enregistrer les changements, soit revenir en arrière.

La page "Utilisateur" offre une interface centralisée pour la gestion des comptes utilisateur. La combinaison du front-end et du back-end permet une manipulation aisée des données et garantit une expérience utilisateur fluide.
1. #### **Capture d’écran des interfaces**
![Screenshot 2023-08-27 202747](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.029.png)![Screenshot 2023-08-27 202907](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.030.png)

<a name="_toc144130684"></a>**Figure 61 Capture d'écran de page de gestion utilisateur**
1. ### <a name="_toc144137583"></a><a name="_toc144149862"></a>**La Page Question**
La page "Question" offre aux administrateurs la possibilité de gérer les questions présentes dans l'application. Cette fonctionnalité permet aux administrateurs de créer de nouvelles questions et de gérer les questions existantes.
1. #### **Front-End :**
- **Navbar et Sidebar** : La page "Question" bénéficie du même ensemble de barre de navigation (navbar) et de barre latérale (sidebar) pour garantir une cohérence visuelle et une expérience utilisateur familière.
- **Tableau des Questions** : Le cœur de la page consiste en un tableau affichant les questions actuellement enregistrées dans la base de données. Chaque ligne du tableau présente les informations clés sur une question, ainsi que des boutons pour accéder à la modification de la question et pour la supprimer.
- **Ajout de Question** : Un élément distinct de cette page est le bouton "Add a Question" En cliquant sur ce bouton, l'administrateur est redirigé vers une page où il peut créer une nouvelle question.
  1. #### **Back-End :**
Le back-end de la page "Question" gère les interactions avec les questions et leur gestion :

- **Suppression de Question** : Lorsqu'un administrateur clique sur le bouton "Supprimer" associé à une question, le back-end supprime cette question de la base de données. Une fois l'action effectuée, l'administrateur est redirigé vers la page principale avec un message de succès indiquant que la question a été supprimée avec succès.
- **Modification de Question** : Si l'administrateur clique sur le bouton "Modifier" associé à une question, il est redirigé vers une page de modification spécifique. Cette page contient un formulaire pré-rempli avec les informations actuelles de la question. L'administrateur peut modifier le contenu de la question et les options de réponse si nécessaire.

function updateQuestiondata($id, $question, $id\_t){

`    `$conn = connect();

`    `$sql = "UPDATE questions SET  question=?, id\_t=? WHERE id\_q=?";

`    `$stmt = $conn->prepare($sql);

`    `$stmt->bindParam(1, $question);

`    `$stmt->bindParam(2, $id\_t);

`    `$stmt->bindParam(3, $id);

`    `$stmt->execute();  

}

- **Ajout de Nouvelle Question** : Lorsque l'administrateur clique sur le bouton "Ajouter Question," il est redirigé vers une page dédiée où il peut créer une nouvelle question. Un formulaire permet de saisir le contenu de la question et son type.

La page "Question" offre une interface centralisée pour la gestion des questions. En combinant le front-end et le back-end, nous permettons aux administrateurs d'ajouter, de modifier et de supprimer des questions de manière intuitive.
1. #### **Capture d’écran des interfaces**
![Screenshot 2023-08-27 203503](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.031.png)

![Screenshot 2023-08-27 203527](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.032.png)![C:\Users\se39040\AppData\Local\Microsoft\Windows\INetCache\Content.Word\Screenshot 2023-08-27 203555.png](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.033.png)

<a name="_toc144130685"></a>**Figure 62 capture d’écran des interfaces gestion des questions A2D**
1. ### <a name="_toc144137584"></a><a name="_toc144149863"></a>**La page Planning**
La page "Planning" offre aux administrateurs la possibilité de gérer les plannings d'audits de l'application. Cette section permet aux administrateurs de visualiser et de manipuler les dates d'audit planifiées.
1. #### **Front-End :**
- **Navbar et Sidebar** : La page "Planning" conserve la barre de navigation (navbar) et la barre latérale (sidebar) pour garantir une expérience utilisateur uniforme.
- **Tableau de Calendrier des Audits** : Le cœur de la page "Planning" est un tableau affichant les jours d'audit planifiés. Au sommet de la page, un champ d'entrée (input) permet à l'administrateur de sélectionner une date qu'il souhaite ajouter au planning.
  1. #### **Back-End**
Le back-end de la page "Planning" gère les interactions avec les jours d'audit planifiés :

- **Suppression d'un Jour** : Lorsqu'un administrateur clique sur le bouton "Supprimer" associé à un jour d'audit dans la colonne du tableau, le back-end permet de supprimer cette date de la base de données. Une fois cette action accomplie, l'administrateur est redirigé vers la page principale avec un message de succès indiquant que le jour a été supprimé avec succès.
- **Ajout d'un Jour** : Lorsque l'administrateur clique sur le bouton "Soumettre," le back-end enregistre la date sélectionnée dans le champ d'entrée. Cette date est ensuite ajoutée au tableau des jours audits dans la base de données. L'administrateur peut voir le calendrier mis à jour avec la nouvelle date ajoutée.

$sql = "SELECT MAX(id) as max\_id FROM a2djour";

`    `$stmt = $conn->prepare($sql);

`    `$stmt->execute();

`    `$maxIdResult = $stmt->fetch(PDO::FETCH\_ASSOC);

`    `$maxId = $maxIdResult["max\_id"];

`    `$id = $maxId + 1;

`    `$date = $\_POST['date-input'];

`    `$sql\_insert = "INSERT INTO a2djour(day,id) VALUES (DATE\_FORMAT(?, '%Y-%m-%d'),?) ";

`    `$stmt\_insert = $conn->prepare($sql\_insert);

`    `$stmt\_insert->bindParam(1, $date);

`    `$stmt\_insert->bindParam(2, $id);

`    `$stmt\_insert->execute();

`    `header("Location: planning.php?s=2");

La page "Planning" offre une interface conviviale pour la gestion des plannings d'audits. En combinant le front-end et le back-end, nous offrons aux administrateurs la possibilité de visualiser, d'ajouter et de supprimer des jours d'audit de manière pratique et efficace.
1. #### **Capture d’écran des interfaces** 
![Screenshot 2023-08-27 205229](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.034.png)

<a name="_toc144130686"></a>**Figure 63 Capture d’écran de page gestion de planning A2D**
1. ### <a name="_toc144137585"></a><a name="_toc144149864"></a>**La page Audit**
La page "Audit" permet aux administrateurs de gérer les audits enregistrés dans l'application. Cette section offre des options pour filtrer et interagir avec les audits existants.
1. #### **Front-End :**
- **Navbar et Sidebar** : La page "Audit" suit la mise en page cohérente avec la barre de navigation (navbar) et la barre latérale (sidebar) présentes dans les autres sections du panneau de contrôle.
- **Filtrage par Mois et Année** : En haut de la page, deux champs "Select" permettent à l'administrateur de choisir le mois et l'année pour lesquels il souhaite filtrer les audits. Cela permet à l'administrateur de visualiser sélectivement les audits en fonction des critères spécifiques.
- **Tableau des Audits** : Le cœur de la page "Audit" est un tableau affichant les informations des audits enregistrés. Chaque ligne du tableau présente des détails sur un audit, avec deux boutons associés : l'un pour accéder aux données d'un audit et l'autre pour supprimer cet audit.
  1. #### **Back-End :**
Le back-end de la page "Audit" gère les interactions avec les audits enregistrés :

- **Filtrage par Mois et Année** : Lorsque l'administrateur sélectionne un mois et une année dans les champs "Select," le back-end filtre les audits en fonction de ces critères pour afficher uniquement les audits correspondants.

if (isset($\_GET['mois'])) {

`        `$selectedMonth = $\_GET['mois'];

`        `$selectedYear = $\_GET['annee'];

`        `if (empty($selectedYear)) {

`            `$selectedYear = date('Y');

`        `}

`        `$audits = getAuditsmy($conn, $selectedMonth, $selectedYear);

`    `}

`    `else{

`    `$audits = getAudits($conn);

`    `}

- **Accès aux Données d'Audit** : En cliquant sur le bouton "Accéder" associé à un audit, l'administrateur est redirigé vers une page spécifique affichant les détails et les données de cet audit.
- **Suppression d'Audit** : Lorsqu'un administrateur clique sur le bouton "Supprimer" associé à un audit, le back-end supprime cet audit de la base de données. Une fois cette action réalisée, l'administrateur est redirigé vers la page "Audit" mise à jour avec un message de succès indiquant que l'audit a été supprimé avec succès.

La page "Audit" offre une interface pratique pour la gestion des audits enregistrés. En intégrant le filtrage, l'accès aux données et la suppression d'audit, nous offrons aux administrateurs des moyens efficaces pour interagir avec les audits dans l'application.
1. #### **Capture d’écran des interfaces:**
![Screenshot 2023-08-27 210315](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.035.png)![Screenshot 2023-08-27 210350](Aspose.Words.9e060543-d21e-4f0d-bbf8-8a58c0aa3229.036.png)
1. # <a name="_toc144137586"></a><a name="_toc144149865"></a>**CONCLUSION**
En somme, cette application d'automatisation d'audit représente une solution puissante pour optimiser la gestion des audits au sein de Stellantis Kenitra. Grâce à une conception soignée et à l'utilisation de technologies telles que HTML, CSS, JavaScript, Bootstrap et SQL, nous avons réussi à créer une plateforme conviviale et fonctionnelle. Les fonctionnalités de filtrage, d'accès aux données, et de planification des audits permettent une gestion plus efficace et une prise de décision éclairée. Cette application offre un moyen pratique et centralisé pour gérer les données d'audit, tout en améliorant la collaboration entre les équipes. En fin de compte, cette application répond aux besoins spécifiques de Stellantis Kenitra et contribue à une gestion plus transparente et efficace des processus d'audit.
1. # <a name="_toc144137587"></a><a name="_toc144149866"></a>**ANTI-DAMAGE DAY VERSION DEMO**
Cette version n'exécute aucune action réelle, mais elle vous permettra d'explorer les interfaces et certaines fonctionnalités de l'application.

Lien :    [ANTI DAMAGE DAY (yahya-fk.github.io)](https://yahya-fk.github.io/Anti-damageDay/index.html)

Lien du interface Admin :  [Login - Admin Panel (yahya-fk.github.io)](https://yahya-fk.github.io/Anti-damageDay/admin/)
# <a name="_toc144137588"></a><a name="_toc144149867"></a>**CONCLUSION GÉNERALE**
En achevant ce projet de conception et de développement d'une application d'automatisation d'audit, nous avons atteint nos objectifs en créant une plateforme robuste et conviviale pour la gestion efficace des audits au sein de l'environnement Stellantis Kenitra. À travers l'implémentation de différentes fonctionnalités, des pages d'interface aux opérations en back-end, notre équipe a travaillé avec diligence pour répondre aux besoins spécifiques de l'entreprise.

Ce projet a présenté divers défis, allant de la collecte et du traitement des données d'audit à la création d'une interface utilisateur intuitive, tout en gérant des éléments clés tels que la sécurité des données sensibles et la facilité d'utilisation pour les utilisateurs finaux.

Notre application d'automatisation d'audit offre plusieurs avantages, notamment :

- **Centralisation des Informations** : L'application permet de centraliser les données d'audit, offrant ainsi une vue d'ensemble claire et précise de l'état de chaque audit.
- **Simplicité d'Utilisation** : Les interfaces utilisateur intuitives facilitent la navigation et la gestion des audits, permettant aux utilisateurs de se concentrer sur leur tâche principale.
- **Gestion Efficace** : Les fonctionnalités de filtrage, d'accès aux données et de suppression permettent aux administrateurs de gérer les audits avec efficacité et précision.
- **Visualisation des Résultats** : Les graphiques et les tableaux de bord fournissent une représentation visuelle des résultats d'audit, aidant ainsi à prendre des décisions informées.
- **Amélioration de la Collaboration** : L'application offre une plateforme centrale pour les utilisateurs de différentes équipes de collaborer et de partager des informations importantes.

Ensemble, nous avons construit une solution puissante pour l'automatisation d'audit, démontrant le potentiel de la technologie pour améliorer les processus opérationnels et la prise de décision au sein d'une organisation.

