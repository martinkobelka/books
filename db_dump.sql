-- MySQL dump 10.19  Distrib 10.3.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: books
-- ------------------------------------------------------
-- Server version	10.3.38-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `year_of_publication` year(4) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `count_of_pages` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `bookbinding` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `authors` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `books_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (4,'Moje vina','Nicholas Leister byl stvořen, aby mi znepříjemňoval život. Vysoký, modré oči, vlasy černé jako noc... Zní to skvěle, že? Ne tak skvěle, když zjistíte, že se z něj stane váš nevlastní bratr a představuje vše, před čím jste odjakživa utíkali.\r\n\r\nNebezpečí – to bylo první, co mě napadlo, když jsem se s ním seznámila a zjistila, že před svým tátou miliardářem skrývá dvojí život.\r\n\r\nJak jsem se do něj mohla zamilovat? Snadno. Člověk s takovýma očima dokáže obrátit váš svět vzhůru nohama.','978-80-277-0397-5',2022,'preview_64b7e32960dd9.png',4,440,'Český','pevná / vázaná','Román','[\"Lilly Lucas\"]'),(6,'Nové vyhlídky','Když se Annie po těžké nehodě probouzí z kómatu, musí se spoustu věcí naučit od začátku. A to nejenom takové věci jako je chůze a psaní, ale musí se naučit především zase žít. Annie se chce co nejrychleji vrátit ke své práci automechaničky v dílně, kterou vede spolu s tátou v městečku Green Valley.\r\n\r\nIdylické prostředí Skalistých hor si ovšem jako svůj úkryt před novináři vybral i Cole Jacobs, seriálová hvězda Netflixu, která se tu především užírá nudou. Annie se pustí do zkoušení vánoční Betlémské hry, aby tak zachránila letní tábor pro děti, a Cole Jacobs se jí připlete do cesty jako pomocný režisér.\r\n\r\nTi dva se ovšem nemůžou v ničem shodnout a Annie je o tolik jiná, než všechny ostatní ženy, které Cole doposud poznal. Najdou spolu vůbec někdy společnou řeč, nebo pochází z až příliš odlišných světů?','978-80-277-2004-0',2023,'preview_64b7e559eed4f.jpg',4,336,'Český','pevná / vázaná','Román','[\"Lilly Lucas\"]'),(7,'Harry Potter a Kámen mudrců','Brýlatý chlapec s nachovou jizvou na čele, připomínající blesk – to je Harry Potter. Jedenáctiletého učedníka čarodějných umění stvořila nadaná spisovatelka J. K. Rowlingová a ze své ostrovní britské vlasti jej vyslala pro potěchu všem duším okouzleným fantazií.\r\n\r\nAž do svých jedenáctých narozenin si o sobě tento hrdina myslel, že je jen obyčejný chlapec. Pak ale dostal soví poštou dopis, kterým byl zván ke studiu na prestižní soukromé Škole čar a kouzel v Bradavicích, a jeho život se rázem změnil. Leccos se dozvídá o minulosti svých zemřelých rodičů, získá pár dobrých kamarádů, naučí se mistrovsky hrát famfrpál a podstoupí souboj se zloduchem Voldemortem…','80-00-00788-6',2000,'preview_64b7e5b1698fa.jpg',3,288,'Český','pevná / vázaná','Fantasy','[\"J. K. Rowling\"]'),(8,'Hospodyně','Jodi Bishopová je úspěšnou realitní makléřkou a živitelkou rodiny. Harrison – její manžel – na ni kvůli tomu žárlí. Kdysi měl své velké sny, ale teď je jen průměrným spisovatelem. Jodi už nebaví neustálá snaha sladit chod rodiny, práci a potřeby vlastních rodičů. Její matka má totiž Parkinsonovu chorobu a zatím se o ni zvládá starat Vic – Jodiin otec. Taky však není nejmladší a neustálá péče jej vyčerpává. Uvítal by pomoc. Jodi se proto rozhodne najmout pro své rodiče hospodyni. Je to ale správné rozhodnutí? Kdo je vlastně ta žena, která najednou nosí matčiny šperky? O co jí jde? A jak daleko je kvůli tomu ochotna zajít?','978-80-242-8871-0',2023,'preview_64b7e62450b3f.jpg',10,353,'Český','pevná / vázaná s přebalem','Detektivka','[\"Joy Fielding\"]'),(9,'Cesta za láskou','Láska se dá najít opravdu kdekoliv, třeba zrovna během dovolené! Kniha obsahuje tři příběhy o cestách za láskou, romantikou, mořem a vášní.\r\n\r\nHorký písek (Petra Nachtmanová): Patricie se díky babičce vypravila na několik týdnů do milované španělské Andalusie. Náhoda jí do cesty přivedla šarmantního maséra Javiera. Je vůbec možné se tak rychle opravdově zamilovat? Váhá, jestli mu věřit.\r\n\r\nČtyřicítka na zabití (Jana Slaninová): Předsudky jsou pro padavky. Sabina musí po svém letním úletu v Turecku přehodnotit celý dosavadní život.\r\n\r\nV síti (Vanda Tomasová): Erika jela na nenáviděnou dovolenou do Itálie. Myslela si, že s kamarádkou převeze tchyni a užije si báječný pobyt. Nemohla se více mýlit. Dostala se do zdánlivé pohody, ale zabředla do osidel, ze kterých není úniku.','978-80-88483-55-7',2023,'preview_64b8f1ddaec32.jpg',5,192,'Český','Elektronická kniha','Román','[\"Petra Nachtmanov\\u00e1\",\"Jana Slaninov\\u00e1\",\"Vanda Tomasov\\u00e1\"]'),(10,'Bílá Voda','Dlouho očekávaný přelomový román o ženách, víře a zlu.\r\n\r\nBílá Voda. Takto poeticky se jmenuje pustá vesnice skrytá ve stínu pohraničních hor, kam kdysi přicházely zástupy poutníků vyprosit si pomoc u zázračné sošky Panny Marie. Právě sem o několik století později přijíždí Lena Lagnerová, aby se tu skryla před svou minulostí, která ji přivedla na pokraj sebevraždy. Namísto kláštera s početnou řeholní komunitou tu však najde pouze několik řádových sester, vedených svéráznou řeholnicí Evaristou. Ta přišla do Bílé Vody o poslední zářijové noci roku 1950, kdy komunistický režim zosobněný démonickým páterem Plojharem odvlekl v rámci Akce Ř všechny řádové sestry do sběrných klášterů. Mladičká Evarista tehdy dostala na výběr: vrátit se do civilního života, nebo s ostatními sdílet jejich příští osud. Nezaváhala ani na okamžik. Stejně jako všechny řeholnice byla nasazena na nucené práce a vystavena ponižování v komunistickém kriminálu i mučení, aby se vzdala víry v Boha. Marně. Lena však zjistí, že tím Evaristin dramatický příběh pouze začíná, a brzy pochopí, že démoni obcházející minulost bělovodských řeholnic nezmizeli, a navíc jsou součástí i jejího vlastního osudu...','978-80-275-1057-3',2022,'preview_64b7e6ebaa13c.jpg',8,646,'Český','pevná / vázaná','Historický román','[\"Kate\\u0159ina Tu\\u010dkov\\u00e1\"]'),(11,'Soumračný obelisk','Oleg se s hrstkou enpécéček vydává hledat Zapovězené město. Cestou je čeká mnoho zkoušek a strastí. Na začátku svého putování ještě netuší, že se k nim blíží horda nokteánů, která opustila údolí Stříbrné hory. Armáda Temných klanů překročila Černý potok. Světlí pronikli k okraji Ledového lesa. Oleg si uvědomuje, že životy kalteánů, kteří mu důvěřují, lze zachránit jediným způsobem: musí aktivovat Soumračný obelisk.','978-80-7594-139-8',2023,'preview_64b7e74dab83f.jpg',7,352,'Český','měkká / brožovaná','Fantasy','[\"Alexej Osad\\u010duk\"]'),(12,'Noc je tvoja','Tajomná pieseň v lese...\r\nOdhalenie vo vojnou sužovanom Francúzsku...\r\nCesta za nádejou.\r\n\r\nZákopy veľkej vojny sú tienisté miesto. Hoci tam seržant Matthew Petticrew prišiel s minulosťou dávno poznačenou tieňmi, skutočná tvár boja so sebou prináša nové rany, ktoré doňho vyrývajú túžbu po svetle a rozhodnutie bojovať zaň.\r\nJednej noci Matthewa s jeho druhmi očarí taký čistý zvuk, taký nadpozemský hlas, že im poskytne úľavu – aj keď len na chvíľu. Zanedlho sa zákopmi začnú šíriť chýry aj od ďalších, ktorí počuli túto uspávanku. Ten hlas nazvali Anjel z Argonne, tajomná neviditeľná bytosť, ktorá za sebou na hroboch bez mien zanecháva vence.\r\n\r\nMireilles vyrastala v divokej hlbočine Argonského lesa a po tom, čo do jej idylického domova vtrhne vojna a pripraví ju o veľa, sa ocitne uprostred trosiek svojho života v ústraní. Keď ju Matthew so svojimi dvomi nečakanými spoločníkmi objaví, musia sa vydať na cestu, ktorá každého z nich navždy zmení... a možno napokon rozžiari svetlo v tme.\r\nSo stým výročím odhalenia pomníka Hrob neznámeho vojaka vznikol dojímavý príbeh inšpirovaný odvahou vojakov z prvej svetovej vojny.','9788082490834',2023,'preview_64b7e7f336c28.jpg',5,678,'Český','měkká / bložovaná','Detektivka','[\"Amanda Dykes\"]'),(13,'Vzpomínky na něj','Kenna Rowanová si odseděla pět let ve vězení za tragický omyl. Teď se vrací zpět do města, kde k tomu všemu došlo, a doufá, že se setká se svou malou dcerkou. Ukazuje se však, že mosty, které za sebou tehdy spálila, už není možné obnovit. Nikdo nevěří, že se změnila. Dostat se k dceři je proto téměř nadlidský úkol. Jediný, kdo ji ještě úplně neodsoudil, je Ledger Ward, majitel místního baru. Kdyby ale vyšlo najevo, že k sobě tihle dva mají blízko, mohlo by to ohrozit důvěru všech, na nichž Ledgerovi záleží. Najde Kenna způsob, jak dát do pořádku minulé chyby, aby si mohla vybudovat novou, lepší budoucnost?','978-80-249-5058-7',2023,'preview_64b7e86ed68df.jpg',6,360,'Český','měkká / brožovaná','Román','[\"Colleen Hoover\"]'),(14,'Deník člověka','Deník člověka : netradičně až poeticky o životě, lásce, štěstí a sebeúctě.\r\n\r\nCo je klíčem ke štěstí, sebeúctě a skutečné lásce v životě? Proč si stále více lidí neváží sebe samých, nedokáží milovat sebe ani druhé, opakují stejné chyby a postrádají radost a blízkost? Proč je to všechno tak složité a řešení jako kdyby bylo vzdálené kilometry daleko?\r\n\r\nKniha navazuje na volně publikované myšlenky stejnojmenného projektu, Deník člověka, na sociálních sítích, který od roku 2018 čte na padesát tisíc fanoušků z Česka i Slovenska.','978-80-7594-139-8 ',1998,'preview_64b7e8d0c51b8.png',6,678,'Český','měkká / brožovaná','Detektivka','[\"Salvo Cabrin\"]'),(15,'Zvrácený','Ona je toxická, pro něj je však útěchou. On je smrtelný, ale pro ni znamená život. Potom, co Beau nechala svého snoubence u oltáře a odešla od miamské policie, nemá její život žádný směr. Smrt její matky byla označena za nehodu. Beau tomu nevěří, ale nemá důkazy o opaku. Sžírá ji bezmoc a vztek. Dokud nepotká Jamese, muže, který se zdá být stejně rozervaný jako ona. A přestože působí chladně, probouzí v ní city. Potěšení. A touhu, které se nedá odolat. Beau však netuší, že James stojí před osudovým rozhodnutím: Buď se jí svěří se svým nejtemnějším tajemstvím, nebo ji bude muset zabít.','978-80-7683-340-1',1999,'preview_64b8f2460efca.jpg',1,234,'Český','pevná / vázaná','Erotika','[\"Jodi Ellen Malpas\"]'),(16,'U severní zdi','Tajemný Muž s dírou v srdci si nese životem nezhojené jizvy na těle i na duši. Dávný zločin, který ho v dětství připravil o rodinu, nebyl nikdy potrestán. Časy se mění, svět kolem však zůstává hluchý, slepý a němý stejně jako kdysi. Všichni už zapomněli nebo se o to usilovně snaží. Až na něj. Spravedlnost se nekoná, a tak musí konat on. Čím víc se blíží jeho vlastní konec, tím naléhavěji jako přízraky z hloubi hromadných hrobů Ďáblického hřbitova vystupují příběhy dětských obětí komunistického režimu. \r\n\r\nV léčebně dlouhodobě nemocných Ošetřovatelka umírajících pomáhá svým pacientům v posledních chvílích jejich pozemského života. S novou klientkou však do ústavu přichází i něco, co je mimo možnosti chápání zdejšího personálu. Bude nutné z léčebny nebo ze svědomí stařečků, kteří tají temnou minulost, vymítat ďábla?\r\nPřišel čas platit účty za padesátá léta.....','978-80-275-1540-0',2023,'preview_64b7e96b83e85.png',6,123,'Český','pevná / vázaná','Román','[\"Petra Klabouchov\\u00e1\"]');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrows`
--

DROP TABLE IF EXISTS `borrows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `end` date NOT NULL,
  `book_id` int(11) NOT NULL,
  `returned` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `borrows_books_id_fk` (`book_id`),
  KEY `borrows_users_id_fk` (`user_id`),
  CONSTRAINT `borrows_books_id_fk` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `borrows_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrows`
--

LOCK TABLES `borrows` WRITE;
/*!40000 ALTER TABLE `borrows` DISABLE KEYS */;
INSERT INTO `borrows` VALUES (42,1,'2023-08-18',9,1),(43,1,'2023-08-18',14,1),(44,1,'2023-08-18',8,1),(45,1,'2023-08-18',13,1),(47,1,'2023-08-18',8,1),(48,1,'2023-08-18',8,1),(49,1,'2023-08-18',8,1),(50,1,'2023-08-18',8,1),(51,1,'2023-08-18',8,1),(52,1,'2023-08-18',8,1),(53,1,'2023-08-18',9,1),(54,1,'2023-08-18',10,1),(55,1,'2023-08-18',10,1),(56,1,'2023-08-18',9,1),(57,1,'2023-08-18',9,1),(58,1,'2023-08-18',9,1),(59,1,'2023-08-18',9,1),(60,1,'2023-08-18',10,1),(61,1,'2023-08-18',9,1),(62,1,'2023-08-18',10,0),(63,1,'2023-08-18',7,1),(64,1,'2023-08-18',8,1),(65,1,'2023-08-18',4,1),(66,1,'2023-08-18',12,1),(67,1,'2023-08-18',6,1),(68,1,'2023-08-18',15,0),(71,2,'2023-08-18',9,1),(72,3,'2023-08-18',4,0),(73,3,'2023-08-18',6,0),(74,3,'2023-08-18',10,0),(75,1,'2023-08-18',14,1),(76,2,'2023-08-19',10,1),(77,2,'2023-08-19',10,1),(78,2,'2023-08-19',10,1),(79,2,'2023-08-19',10,1),(80,2,'2023-08-19',10,1),(81,2,'2023-08-19',10,1),(82,2,'2023-08-19',6,1),(83,2,'2023-08-19',7,1),(84,2,'2023-08-19',7,1),(85,2,'2023-08-19',7,1),(86,2,'2023-08-19',9,1),(87,2,'2023-08-19',14,1),(88,2,'2023-08-19',14,1),(89,2,'2023-08-19',14,1),(90,2,'2023-08-19',14,1),(91,2,'2023-08-19',14,1),(92,2,'2023-08-19',14,0),(95,2,'2023-08-19',7,1),(96,2,'2023-08-19',7,1),(97,2,'2023-08-19',7,1),(98,2,'2023-08-19',7,1),(99,2,'2023-08-19',7,1),(100,2,'2023-08-19',7,1),(101,2,'2023-08-19',7,1),(102,2,'2023-08-19',7,1),(103,2,'2023-08-19',7,1),(104,2,'2023-08-19',7,1),(105,2,'2023-08-19',9,1),(106,2,'2023-08-19',9,0),(107,2,'2023-08-19',13,1);
/*!40000 ALTER TABLE `borrows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','849b28dcbe2c37b2c60d994e5dbd4b21535d0701','UyOCr6jIiEU6rBKE',NULL,1),(2,'martin','849b28dcbe2c37b2c60d994e5dbd4b21535d0701','oIgWDb30fa6be2XD',NULL,0),(3,'pavel','849b28dcbe2c37b2c60d994e5dbd4b21535d0701','5Rcbs6VUS07dGBjr',NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-20 11:16:24
