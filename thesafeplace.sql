-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 avr. 2024 à 14:13
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `thesafeplace`
--

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

DROP TABLE IF EXISTS `eleves`;
CREATE TABLE IF NOT EXISTS `eleves` (
  `eleve_id` int NOT NULL AUTO_INCREMENT,
  `classe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `code_etablissement` int NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(100) NOT NULL,
  `age` int DEFAULT NULL,
  PRIMARY KEY (`eleve_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classe` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option_1` varchar(255) DEFAULT NULL,
  `option_2` varchar(255) DEFAULT NULL,
  `option_3` varchar(255) DEFAULT NULL,
  `option_4` varchar(255) DEFAULT NULL,
  `correct_option` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`id`, `classe`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_option`) VALUES
(1, 'CE2', 'Que signifie le terme \"cyberharcèlement\" ?', 'Seulement des commentaires négatifs', 'Harcèlement en ligne via les réseaux sociaux, emails, etc.', 'Discuter en ligne avec des amis', 'Publier des photos sans consentement', 2),
(2, 'CE2', 'Quel est un signe commun du cyberharcèlement ?', 'Recevoir des compliments en ligne', 'Messages répétés ou menaces en ligne', 'Discussions amicales sur les réseaux sociaux', 'Recevoir des demandes d\'amitié', 2),
(3, 'CE2', 'Que devriez-vous faire si vous êtes victime de cyberharcèlement ?', 'Le garder pour soi', 'En parler à un adulte de confiance', 'Se venger en ligne', 'Supprimer tous ses comptes de réseaux sociaux', 2),
(4, 'CE2', 'Comment peut-on aider quelqu\'un qui est cyberharcelé ?', 'En l\'écoutant et en le soutenant', 'En ignorant la situation', 'En confrontant l\'agresseur en ligne', 'En partageant les messages harcelants', 1),
(5, 'CE2', 'Quelles mesures préventives peut-on prendre contre le cyberharcèlement ?', 'Partager ses mots de passe avec des amis', 'Garder ses paramètres de confidentialité élevés sur les réseaux sociaux', 'Répondre agressivement aux messages haineux', 'Publier des informations personnelles en ligne', 2),
(6, 'CE2', 'Qui peut être tenu responsable dans des cas de cyberharcèlement ?', 'Seulement la victime', 'L\'auteur du harcèlement', 'Les témoins qui n\'interviennent pas', 'Les plateformes de réseaux sociaux uniquement', 2),
(7, 'CE2', 'Quel rôle jouent les réseaux sociaux dans le cyberharcèlement ?', 'Aucun, ils ne sont pas responsables', 'Ils peuvent être des plateformes facilitant le harcèlement', 'Ils préviennent activement tout type de harcèlement', 'Ils suppriment automatiquement les messages harcelants', 2),
(8, 'CE2', 'Qu\'est-ce qu\'une conséquence possible du cyberharcèlement ?', 'Amélioration des compétences sociales', 'Effets néfastes sur la santé mentale', 'Augmentation de la popularité en ligne', 'Aucune, il n\'y a pas de conséquences', 2),
(9, 'CE2', 'Comment les victimes de cyberharcèlement se sentent-elles souvent ?', 'Isolées et anxieuses', 'Excitées et heureuses', 'Indifférentes', 'Motivées à socialiser plus en ligne', 1),
(10, 'CE2', 'Quelle est la meilleure façon de réagir face à un message de cyberharcèlement ?', 'L\'effacer immédiatement sans en parler', 'Documenter le message et en parler à un adulte de confiance', 'Répondre avec des insultes', 'Partager le message sur ses propres réseaux sociaux', 2),
(11, 'CM2', 'Que dois-tu faire si tu vois quelqu\'un être cyberharcelé ?', 'Rire et participer', 'Ignorer', 'Signaler à un adulte', 'Créer un autre compte pour aider', 3),
(12, 'CM2', 'Quelle attitude est importante pour éviter le cyberharcèlement ?', 'Partager tout en ligne', 'Utiliser de vrais noms partout', 'Respecter les autres', 'Poster des photos de tous', 3),
(13, 'CM2', 'Si quelqu’un te demande tes informations personnelles en ligne, tu devrais :', 'Les donner si la personne semble gentille', 'Les partager seulement avec des amis', 'Ne pas les partager du tout', 'Les partager si c’est un compte vérifié', 3),
(14, 'CM2', 'Qu’est-ce que le \"doxing\" dans le contexte du cyberharcèlement ?', 'Partager des jeux en ligne', 'Envoyer des cartes virtuelles', 'Publier des informations personnelles sans consentement', 'Faire des compliments en ligne', 3),
(15, 'CM2', 'Pourquoi est-il important de garder ses comptes en mode privé ?', 'Pour avoir plus d’amis en ligne', 'Pour éviter le cyberharcèlement', 'Pour rendre le profil plus attrayant', 'Pour gagner des followers', 2),
(16, 'CM2', 'Que signifie être empathique en ligne ?', 'Poster des photos amusantes', 'Comprendre les sentiments des autres', 'Avoir beaucoup d’amis en ligne', 'Gagner des jeux en ligne', 2),
(17, 'CM2', 'Que faire si quelqu’un te harcèle en ligne ?', 'Changer d’école', 'Répondre avec colère', 'Bloquer la personne et en parler à un adulte', 'Supprimer l’internet', 3),
(18, 'CM2', 'Quel est un exemple de cyberharcèlement ?', 'Aimer les publications de quelqu’un', 'Envoyer des invitations à jouer', 'Poster des commentaires méchants de façon répétée', 'Partager de la musique', 3),
(19, 'CM2', 'Comment les réseaux sociaux peuvent-ils aider à combattre le cyberharcèlement ?', 'En supprimant les comptes des victimes', 'En ignorant les plaintes', 'En permettant de signaler et bloquer les harceleurs', 'En publiant plus de publicités', 3),
(20, 'CM2', 'Pourquoi est-il important de parler du cyberharcèlement ?', 'Pour rendre le harcèlement plus connu', 'Pour effrayer les enfants', 'Pour aider à prévenir et arrêter le harcèlement', 'Pour avoir quelque chose à dire', 3),
(21, '5', 'Quelle loi protège contre le cyberharcèlement en France ?', 'La loi sur la liberté de presse', 'Le code du cyberespace', 'La loi pour la confiance dans l’économie numérique', 'Le code pénal', 4),
(22, '5', 'Quel effet le cyberharcèlement a-t-il sur les victimes ?', 'Il les rend plus populaires', 'Il n’a aucun effet', 'Il peut causer de la détresse psychologique', 'Il améliore leur réputation en ligne', 3),
(23, '5', 'Comment peut-on réduire le risque de devenir une victime de cyberharcèlement ?', 'En partageant tout en ligne', 'En maintenant ses profils en public', 'En utilisant des pseudonymes', 'En répondant aux messages haineux', 3),
(24, '5', 'Qu’est-ce qu’un comportement en ligne responsable ?', 'Poster tout ce qui nous vient à l’esprit', 'Respecter la vie privée des autres', 'Suivre tout le monde en retour', 'Partager des rumeurs', 2),
(25, '5', 'Pourquoi est-il important de choisir ses mots avec soin sur internet ?', 'Pour écrire plus vite', 'Pour éviter les malentendus et le harcèlement', 'Pour gagner des concours d’écriture', 'Pour impressionner les autres', 2),
(26, '5', 'Quelle est la première étape à suivre en cas de cyberharcèlement ?', 'Supprimer son profil en ligne', 'Répondre avec colère', 'Documenter les abus', 'Fermer son ordinateur', 3),
(27, '5', 'Qu’est-ce qu’un \"troll\" en ligne ?', 'Un type de jeu vidéo', 'Quelqu’un qui poste des commentaires pour provoquer ou harceler', 'Un nouveau réseau social', 'Une application de messagerie', 2),
(28, '5', 'Comment les écoles peuvent-elles aider à prévenir le cyberharcèlement ?', 'En bloquant l’accès à internet', 'En ignorant le problème', 'En éduquant les élèves sur la citoyenneté numérique', 'En fermant les comptes des élèves', 3),
(29, '5', 'Quel rôle les parents peuvent-ils jouer dans la prévention du cyberharcèlement ?', 'Vérifier les devoirs chaque soir', 'Contrôler strictement toutes les activités en ligne', 'Éduquer sur l’utilisation sûre et respectueuse d’internet', 'Laisser les enfants naviguer sur internet sans supervision', 3),
(30, '5', 'Que faire avec les comptes de réseaux sociaux pour réduire le risque de harcèlement ?', 'Les supprimer tous', 'Les rendre tous publics', 'Sélectionner soigneusement qui peut voir les publications', 'Partager les mots de passe avec des amis', 3),
(31, '3', 'Quelle est la différence entre le harcèlement et le cyberharcèlement ?', 'Le cyberharcèlement est moins sérieux', 'Le harcèlement n’est pas illégal', 'Le cyberharcèlement peut se produire 24/7', 'Le harcèlement est uniquement en ligne', 3),
(32, '3', 'Comment la loi française définit-elle le cyberharcèlement ?', 'Comme un désaccord en ligne', 'Comme une forme de liberté d’expression', 'Comme une conduite répétée qui vise à nuire', 'Comme une utilisation normale des réseaux sociaux', 3),
(33, '3', 'Quel est le rôle des témoins de cyberharcèlement ?', 'Encourager les harceleurs', 'Ignorer les incidents', 'Signaler les abus aux autorités compétentes', 'Supprimer leur propre compte', 3),
(34, '3', 'Pourquoi est-il crucial de parler du cyberharcèlement ?', 'Pour rendre le problème plus grave', 'Pour dissuader les gens d’utiliser internet', 'Pour sensibiliser et trouver des solutions', 'Pour faire peur aux utilisateurs d’internet', 3),
(35, '3', 'Quels sont les impacts à long terme du cyberharcèlement sur les victimes ?', 'Aucun impact', 'Popularité accrue', 'Problèmes de santé mentale et isolement social', 'Meilleures compétences informatiques', 3),
(36, '3', 'Comment les victimes de cyberharcèlement peuvent-elles obtenir de l’aide ?', 'En se vengeant', 'En ne parlant à personne', 'En contactant des organisations spécialisées', 'En fermant simplement leur ordinateur', 3),
(37, '3', 'Quelle mesure préventive n’est PAS efficace contre le cyberharcèlement ?', 'Augmenter la sensibilisation', 'Ignorer et ne pas signaler les incidents', 'Garder les paramètres de confidentialité stricts', 'Éduquer sur la netiquette', 2),
(38, '3', 'Comment identifier un cas de cyberharcèlement ?', 'Quand quelqu’un reçoit des compliments', 'Quand il y a un désaccord ponctuel en ligne', 'Quand il y a des attaques personnelles répétées', 'Quand quelqu’un poste de nombreuses photos', 3),
(39, '3', 'Pourquoi est-il important de maintenir une empreinte numérique positive ?', 'Pour devenir célèbre en ligne', 'Pour éviter d’être ciblé par le cyberharcèlement', 'Pour augmenter le nombre de followers', 'Pour obtenir des récompenses virtuelles', 2),
(40, '3', 'Quelles actions spécifiques peuvent être considérées comme du cyberharcèlement ?', 'Partager des actualités', 'Aimer des publications', 'Envoyer des messages menaçants, créer des faux profils pour humilier quelqu’un', 'Faire des quiz en ligne', 3);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` int DEFAULT NULL,
  `eleve_id` int DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `try` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `eleve_id` (`eleve_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

DROP TABLE IF EXISTS `parents`;
CREATE TABLE IF NOT EXISTS `parents` (
  `parent_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `enfant_id` int DEFAULT NULL,
  PRIMARY KEY (`parent_id`),
  KEY `fk_eleve_id` (`enfant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE IF NOT EXISTS `quizz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classe` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `option_1` varchar(255) DEFAULT NULL,
  `option_2` varchar(255) DEFAULT NULL,
  `option_3` varchar(255) DEFAULT NULL,
  `option_4` varchar(255) DEFAULT NULL,
  `correct_option` int DEFAULT NULL,
  `numero` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quizz`
--

INSERT INTO `quizz` (`id`, `classe`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_option`, `numero`) VALUES
(96, '5', 'Pourquoi est-il important de garder ses paramètres de confidentialité élevés ?', 'Pour avoir plus d\'amis en ligne', 'Pour partager ses informations avec tout le monde', 'Pour protéger sa vie privée et éviter le cyberharcèlement', 'Pour se rendre plus facilement trouvable en ligne', 3, 3),
(95, '5', 'Quelle attitude est recommandée quand on navigue en ligne ?', 'Croire tout ce que l\'on voit', 'Partager rapidement des informations sans vérification', 'Vérifier l\'authenticité des informations avant de les partager', 'Utiliser Internet uniquement pour les jeux', 3, 3),
(94, '5', 'Comment sécuriser ses comptes en ligne contre le cyberharcèlement ?', 'Utiliser des mots de passe faciles', 'Partager ses identifiants avec des amis', 'Changer régulièrement de mot de passe', 'Utiliser le même mot de passe pour tous les comptes', 3, 3),
(92, '5', 'Comment réagir à un ami qui partage des messages de cyberharcèlement ?', 'Les ignorer', 'Rire et les partager', 'Les signaler', 'Encourager l\'ami à continuer', 3, 2),
(93, '5', 'Qu\'est-ce qu\'un bon comportement en ligne ?', 'Partager tout ce que l\'on fait', 'Avoir des discussions respectueuses', 'Se moquer des erreurs des autres', 'Utiliser un langage grossier pour être cool', 2, 3),
(91, '5', 'Quel est le rôle des réseaux sociaux dans le cyberharcèlement ?', 'Ils sont entièrement responsables du cyberharcèlement', 'Ils n\'ont aucun rôle', 'Ils peuvent faciliter le cyberharcèlement sans politiques adéquates', 'Ils arrêtent automatiquement tout cyberharcèlement', 3, 2),
(90, '5', 'Que devrait inclure un mot de passe sécurisé ?', 'Le nom de ton animal de compagnie', 'Ta date de naissance', 'Une combinaison de lettres, chiffres et symboles', 'Ton nom et prénom', 3, 2),
(89, '5', 'Quelle action ne contribue PAS à lutter contre le cyberharcèlement ?', 'Encourager la victime à en parler', 'Ignorer les messages de harcèlement', 'Signaler le contenu harcelant', 'Parler des dangers du cyberharcèlement en classe', 2, 2),
(88, '5', 'Quels effets le cyberharcèlement peut-il avoir sur la victime ?', 'Augmentation de la popularité', 'Sentiment de tristesse passager', 'Problèmes de santé mentale', 'Aucun effet', 3, 1),
(87, '5', 'Pourquoi est-il important de parler du cyberharcèlement ?', 'Pour attirer l\'attention', 'Pour rendre le harceleur célèbre', 'Pour aider à stopper le harcèlement', 'Pour partager des histoires', 3, 1),
(86, '5', 'Que faire si on est victime de cyberharcèlement ?', 'Le cacher et espérer que ça passe', 'Se venger en harcelant en retour', 'Bloquer le harceleur et en parler à un adulte', 'Supprimer tous ses comptes en ligne', 3, 1),
(85, '5', 'Comment identifier un cas de cyberharcèlement ?', 'Une simple plaisanterie entre amis', 'Une critique constructive', 'Des messages répétés et menaçants', 'Un débat en ligne', 3, 1),
(84, 'CE2', 'Pourquoi est-il important d’avoir des mots de passe forts ?', 'Pour les partager facilement avec des amis', 'Pour se connecter plus rapidement', 'Pour protéger ses informations personnelles', 'Pour s’en souvenir plus facilement', 3, 4),
(74, 'CE2', 'Comment devrais-tu réagir aux messages haineux ?', 'Les ignorer', 'En parler à tes parents ou à un enseignant', 'Les effacer', 'Rire et les partager avec des amis', 2, 2),
(75, 'CE2', 'Pourquoi est-il important de choisir ses amis en ligne avec soin ?', 'Pour avoir plus de likes', 'Pour éviter les cyberharceleurs', 'Pour devenir populaire', 'Pour avoir plus de jeux', 2, 2),
(76, 'CE2', 'Quelle action N\'EST PAS appropriée si on est témoin de cyberharcèlement ?', 'L’ignorer', 'Le signaler', 'En parler à un adulte', 'Encourager le harceleur', 1, 2),
(77, 'CE2', 'Quel est un bon moyen de prévenir le cyberharcèlement ?', 'Partager son mot de passe', 'Être méchant en retour', 'Avoir des conversations privées avec des inconnus', 'Garder ses comptes en mode privé', 4, 3),
(78, 'CE2', 'Que devrais-tu faire avec des messages de harcèlement ?', 'Les supprimer', 'Les envoyer à un adulte', 'Les ignorer', 'Les partager sur ton profil', 2, 3),
(79, 'CE2', 'Que signifie être un bon citoyen numérique ?', 'Partager tout sur les réseaux sociaux', 'Être respectueux en ligne', 'Jouer en ligne tout le temps', 'Télécharger illégalement des films', 2, 3),
(80, 'CE2', 'Comment réagir face à une demande d’information personnelle en ligne ?', 'Partager l’information', 'Ignorer la demande', 'En informer un adulte', 'Créer une fausse identité', 3, 3),
(81, 'CE2', 'Qu’est-ce qu’un comportement sûr en ligne ?', 'Accepter tous les amis sur les réseaux sociaux', 'Partager des photos de soi-même en ligne', 'Utiliser des surnoms pour tous les comptes', 'Ne pas partager d’informations personnelles', 4, 4),
(82, 'CE2', 'Comment peux-tu aider un ami qui est cyberharcelé ?', 'En lui disant d’ignorer le problème', 'En harcelant la personne en retour', 'En parlant avec lui et en l’encourageant à en parler à un adulte', 'En partageant les messages de harcèlement', 3, 4),
(83, 'CE2', 'Que faire si tu vois un contenu inapproprié en ligne ?', 'Le partager', 'L’ignorer', 'Le signaler', 'En rire', 3, 4),
(73, 'CE2', 'Qu’est-ce que le cyberharcèlement ?', 'Discuter en ligne', 'Partager des images sans permission', 'Envoyer des messages menaçants ou moqueurs', 'Jouer à des jeux en ligne', 3, 2),
(72, 'CE2', 'Quel comportement est approprié sur les réseaux sociaux ?', 'Publier tout et n’importe quoi', 'Partager des secrets d’amis', 'Être gentil et respectueux', 'Accepter toutes les demandes d’ajout', 3, 1),
(71, 'CE2', 'Si quelqu’un te harcèle en ligne, qui devrais-tu en informer ?', 'Un ami', 'Un adulte de confiance', 'Personne, il faut garder cela pour soi', 'Répondre au harceleur', 2, 1),
(69, 'CE2', 'Que doit-on faire si on reçoit des messages méchants en ligne ?', 'Les ignorer', 'Répondre méchamment', 'En parler à un adulte', 'Les supprimer sans en parler', 3, 1),
(70, 'CE2', 'Quelle est la meilleure manière de se protéger contre le cyberharcèlement ?', 'Partager son mot de passe avec des amis', 'Accepter tous les amis en ligne', 'Ne pas partager d’informations personnelles en ligne', 'Utiliser un pseudo rigolo', 3, 1),
(68, 'CM2', 'Quelle mesure est essentielle pour protéger son identité en ligne ?', 'Partager régulièrement ses données personnelles', 'Faire attention aux informations partagées sur les réseaux sociaux', 'Utiliser toujours le même pseudonyme', 'Accepter toutes les demandes d\'amis pour être populaire', 2, 4),
(67, 'CM2', 'Comment peut-on contribuer à créer un environnement en ligne plus sûr ?', 'En partageant tout ce que l\'on voit', 'En étant respectueux et en signalant les abus', 'En participant aux moqueries pour s\'intégrer', 'En ne faisant rien, les autres s\'en chargeront', 2, 4),
(66, 'CM2', 'Quel est l\'impact du cyberharcèlement sur les victimes ?', 'Des conséquences psychologiques graves', 'Aucun impact, c\'est juste en ligne', 'Les victimes deviennent plus populaires', 'Cela les rend plus forts', 1, 4),
(65, 'CM2', 'Pourquoi est-il important de vérifier les sources d\'une information avant de la partager ?', 'Pour éviter de propager des fausses nouvelles', 'Parce que c\'est plus amusant de partager rapidement', 'Pour augmenter le nombre de ses abonnés', 'Aucune raison, partager est toujours bon', 1, 4),
(64, 'CM2', 'Que faire si vous recevez un lien suspect d\'un ami ?', 'Cliquer pour voir ce que c\'est', 'Ne pas cliquer et prévenir votre ami', 'Partager le lien avec d\'autres amis', 'Ignorer le message', 2, 3),
(63, 'CM2', 'Quelle attitude est recommandée pour sécuriser ses comptes en ligne ?', 'Utiliser des mots de passe forts et uniques', 'Partager ses mots de passe avec des amis', 'Utiliser le même mot de passe pour faciliter la mémorisation', 'Écrire ses mots de passe sur un papier', 1, 3),
(62, 'CM2', 'Comment réagir face à un message haineux en ligne ?', 'Y répondre avec colère', 'Ne pas répondre et le signaler', 'Le partager pour montrer l\'absurdité', 'En rire et l\'ignorer', 2, 3),
(61, 'CM2', 'Quel comportement adopter en ligne pour éviter le cyberharcèlement ?', 'Être respectueux et bienveillant', 'Partager tout ce que l\'on pense', 'Se moquer des autres pour être drôle', 'Utiliser l\'anonymat pour critiquer', 1, 3),
(60, 'CM2', 'Quel est le meilleur moyen de protéger sa vie privée en ligne ?', 'Utiliser le même mot de passe partout', 'Activer les paramètres de confidentialité sur les réseaux sociaux', 'Publier des informations personnelles', 'Accepter toutes les demandes d\'amis', 2, 2),
(59, 'CM2', 'Quelle plateforme permet de signaler anonymement le cyberharcèlement ?', '3018', 'Facebook', 'Instagram', 'Snapchat', 1, 2),
(58, 'CM2', 'Que faire si vous voyez un ami être cyberharcelé ?', 'L\'ignorer, c\'est son problème', 'Le soutenir et l\'encourager à en parler', 'Participer au harcèlement pour être populaire', 'Diffuser l\'information pour sensibiliser', 2, 2),
(56, 'CM2', 'Quelles informations ne faut-il jamais partager en ligne ?', 'Ses préférences musicales', 'Son adresse personnelle', 'Ses hobbies', 'Les noms de ses animaux de compagnie', 2, 1),
(57, 'CM2', 'Comment réagir si quelqu\'un vous demande des photos inappropriées en ligne ?', 'Refuser et en parler à un adulte', 'Envoyer les photos pour ne pas perdre un ami', 'Ignorer la demande sans en parler', 'Rire de la demande', 1, 2),
(55, 'CM2', 'Quel est le premier pas à faire quand on est témoin de cyberharcèlement ?', 'Signaler le contenu aux plateformes concernées', 'Ignorer la situation', 'Participer au harcèlement', 'Rire et partager le contenu', 1, 1),
(54, 'CM2', 'Qui peut être averti en cas de cyberharcèlement ?', 'Personne, il faut le garder pour soi', 'La police ou la gendarmerie', 'Les amis seulement', 'Les inconnus en ligne pour obtenir de l\'aide', 2, 1),
(53, 'CM2', 'Quelle est la meilleure action à prendre en cas de cyberharcèlement ?', 'Ignorer les messages', 'Répondre avec colère', 'En parler à un adulte de confiance', 'Supprimer son profil sur les réseaux sociaux', 3, 1),
(97, '5', 'Quelle action N\'EST PAS utile pour aider quelqu\'un victime de cyberharcèlement ?', 'Conseiller à la personne de se venger', 'Écouter la personne et la soutenir', 'Encourager la personne à en parler à un adulte', 'Signaler le cyberharcèlement aux plateformes concernées', 1, 4),
(98, '5', 'Qu\'est-ce que le \"doxxing\" ?', 'Partager ses propres informations en ligne', 'Rechercher des informations en ligne', 'Publier en ligne des informations privées sur quelqu\'un sans son consentement', 'Jouer à des jeux en ligne avec des amis', 3, 4),
(99, '5', 'Comment peut-on réduire le risque d\'être cyberharcelé ?', 'En acceptant toutes les demandes d\'amitié', 'En ne se connectant jamais à Internet', 'En maintenant ses comptes en mode privé', 'En partageant des détails personnels pour montrer sa transparence', 3, 4),
(100, '5', 'Quel est l\'effet du cyberharcèlement sur l\'estime de soi ?', 'Amélioration de la confiance en soi', 'Aucun effet', 'Détérioration de l\'estime de soi', 'Augmentation du désir de socialiser', 3, 4),
(101, '3', 'Quelle est la première étape à suivre lorsque l’on est victime de cyberharcèlement ?', 'Confronter le harceleur en ligne', 'Supprimer ou bloquer immédiatement le harceleur', 'En parler à un adulte de confiance', 'Rendre son propre compte privé', 3, 1),
(102, '3', 'Quel rôle les écoles peuvent-elles jouer dans la prévention du cyberharcèlement ?', 'Ignorer le problème, car il se passe en ligne', 'Punir sévèrement tout élève impliqué', 'Informer et éduquer les élèves sur le cyberharcèlement', 'Bloquer l’accès à tous les réseaux sociaux', 3, 1),
(103, '3', 'Comment les victimes de cyberharcèlement se sentent-elles souvent ?', 'Motivées à utiliser davantage les réseaux sociaux', 'Heureuses et amusées', 'Seules et impuissantes', 'Excitées à l’idée de rencontrer de nouvelles personnes en ligne', 3, 1),
(104, '3', 'Qu’est-ce que le \"grooming\" en ligne ?', 'Créer de nouveaux profils sur les réseaux sociaux', 'Le processus par lequel un individu établit une connexion émotionnelle avec un enfant pour en abuser', 'Participer à des groupes en ligne pour partager des hobbies', 'Nettoyer son profil en ligne de tout contenu inapproprié', 2, 1),
(105, '3', 'Quelle mesure légale peut être prise contre le cyberharcèlement en France ?', 'Aucune, car le cyberharcèlement est difficile à prouver', 'Une amende pour les parents de l’agresseur', 'Des mesures disciplinaires scolaires uniquement', 'Des peines de prison et des amendes pour les coupables', 4, 2),
(106, '3', 'Pourquoi est-il important de préserver une bonne empreinte numérique ?', 'Pour augmenter ses chances d’être célèbre en ligne', 'Pour éviter les amendes', 'Pour s’assurer de bonnes opportunités futures, telles que l’emploi ou l’éducation', 'Pour avoir plus d’abonnés sur les réseaux sociaux', 3, 2),
(107, '3', 'Qu’est-ce qu’une réponse appropriée face à un cyberharceleur ?', 'L’insulter en retour', 'Créer un faux compte pour se venger', 'Ignorer les messages et en parler à un adulte', 'Supprimer tous ses comptes sur les réseaux sociaux', 3, 2),
(108, '3', 'Quel est l’impact du cyberharcèlement sur les témoins ?', 'Ils se sentent amusés et divertis', 'Ils peuvent devenir anxieux ou craintifs d’être les prochaines victimes', 'Ils deviennent plus populaires en partageant le contenu', 'Aucun impact, car ils ne sont que des spectateurs', 2, 2),
(109, '3', 'Que doit-on faire avant de partager des informations personnelles en ligne ?', 'Les partager uniquement avec des personnes que l’on connaît en ligne', 'Demander l’avis de tous ses abonnés', 'Réfléchir aux conséquences potentielles et à qui pourrait les voir', 'Les publier sur tous ses comptes pour obtenir des avis', 3, 3),
(110, '3', 'Comment identifier une tentative de phishing ?', 'Par le logo officiel de l’entité imitée dans l’email', 'Par l’offre d’une récompense importante pour une action simple', 'Par l’orthographe correcte dans l’email', 'Si l’email provient d’une adresse connue', 2, 3),
(111, '3', 'Qu’est-ce que le consentement numérique ?', 'Accepter toutes les conditions d’utilisation sans les lire', 'Donner son accord avant de partager des informations personnelles d’autrui', 'Utiliser des photos sans permission, mais avec de bonnes intentions', 'S’inscrire à des sites Web avec un email secondaire', 2, 3),
(112, '3', 'Pourquoi est-il important de configurer les paramètres de confidentialité sur les réseaux sociaux ?', 'Pour personnaliser son profil', 'Pour recevoir des publicités ciblées', 'Pour contrôler qui peut voir ses informations et publications', 'Pour augmenter le nombre de ses amis et abonnés', 3, 3),
(113, '3', 'Quelles actions un établissement scolaire peut-il entreprendre face au cyberharcèlement entre élèves ?', 'Exclure immédiatement tout élève impliqué', 'Conseiller aux élèves d’ignorer le cyberharcèlement', 'Organiser des ateliers de sensibilisation et mettre en place une politique claire', 'Surveiller les messages privés des élèves sur les réseaux sociaux', 3, 4),
(114, '3', 'Quel conseil donneriez-vous à quelqu’un pour qu’il crée des mots de passe sécurisés ?', 'Utiliser le même mot de passe pour tous les comptes', 'Choisir des mots de passe courts et simples', 'Inclure son nom ou date de naissance pour s’en souvenir facilement', 'Utiliser une combinaison complexe de lettres, chiffres et symboles', 4, 4),
(115, '3', 'Quel est le danger de participer à des défis viraux sur les réseaux sociaux ?', 'Ne pas avoir assez de likes ou d’abonnés', 'Peut exposer les participants à des risques physiques et compromettre leur vie privée', 'Perdre du temps qui pourrait être utilisé pour étudier', 'Ne pas suivre les tendances actuelles', 2, 4),
(116, '3', 'Comment réagir si un ami partage avec vous du contenu de cyberharcèlement ?', 'Le féliciter pour avoir partagé le contenu', 'Le partager avec plus de personnes', 'L’encourager à supprimer le contenu et à en parler à un adulte', 'Créer un meme à partir du contenu partagé', 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `video_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `classe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `videos`
--

INSERT INTO `videos` (`video_id`, `name`, `classe`) VALUES
(1, 'CE2_1.MP4', 'CE2'),
(2, 'CE2_2.MP4', 'CE2'),
(3, 'CM2_1.MP4', 'CM2'),
(4, 'CM2_2.MP4', 'CM2'),
(5, '5_1.MP4', '5'),
(6, '3_1.MP4', '3'),
(7, '3_2.MP4', '3'),
(8, 'video1.mp4', 'ALL'),
(9, 'video2.mp4', 'ALL'),
(10, 'video3.mp4', 'ALL');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
