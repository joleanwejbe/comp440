<?php 

include("authenticate.php");

//drops table

// Creates new database



$sql = "Drop TABLE IF EXISTS phplogin;";



mysqli_query($con, $sql);



$sql = "Create schema IF not EXISTS phplogin;";

mysqli_query($con, $sql);



$sql = "use phplogin";

mysqli_query($con, $sql);



$usersTable = " CREATE TABLE users (

    id int(11) NOT NULL AUTO_INCREMENT,

    username varchar(50) NOT NULL,

    password varchar(255) NOT NULL,

    firstName varchar(100) NOT NULL,

    lastName varchar(100) NOT NULL,

    email varchar(100) NOT NULL,

    PRIMARY KEY (`id`)

);";



$blogsTable = " CREATE TABLE blogs (

  blogid int(10) unsigned NOT NULL AUTO_INCREMENT,

  subject varchar(50) DEFAULT NULL,

  description varchar(250) DEFAULT NULL,

  pdate date DEFAULT NULL,

  created_by varchar(45) DEFAULT NULL,

  PRIMARY KEY (`blogid`),

  KEY `FK1_idx` (`description`),

  KEY `FK1` (`created_by`)

);";



$blogTagsTable = "CREATE TABLE blogstags (

  blogid int(10) unsigned NOT NULL,

  tag varchar(20) NOT NULL,

  PRIMARY KEY (`blogid`,`tag`)

);";



$commentsTable = "CREATE TABLE comments (

  commentid int(10) NOT NULL AUTO_INCREMENT,

  sentiment varchar(20) DEFAULT NULL,

  description varchar(250) DEFAULT NULL,

  cdate date DEFAULT NULL,

  blogid int(10) unsigned DEFAULT NULL,

  posted_by varchar(45) DEFAULT NULL,

  PRIMARY KEY (`commentid`),

  KEY `comments_ibfk_1` (`blogid`),

  KEY `comments_ibfk_2` (`posted_by`)

);";



$followsTable = "CREATE TABLE follows (

  leadername varchar(45) NOT NULL,

  followername varchar(45) NOT NULL,

  PRIMARY KEY (`leadername`,`followername`),

  KEY `follows_ibfk_2` (`followername`)

);";



$hobbiesTable = "CREATE TABLE hobbies (

  username varchar(45)  NOT NULL,

  hobby varchar(20) NOT NULL,

  PRIMARY KEY (`hobby`,`username`),

  KEY `hobbies_ibfk_1` (`username`)

);";





$tables = [$usersTable, $blogsTable, $blogTagsTable,$commentsTable,$followsTable,$hobbiesTable];



foreach($tables as $k => $sql)

{

	mysqli_query($con, $sql);

}





$userQuery = "INSERT INTO users (`id`, `username`, `password`, `firstName`, `lastName`, `email`) VALUES (1, 'test', 'test', 'firstTest', 'lastTest', 'test@test.com'); ";

$blogQuery = "INSERT INTO blogs VALUES (1,'Hello World','Hey everyone, this is my first blog. Hello world and all who inhabit it!','2020-03-15','jsmith'),(2,'I love cats!','Cats are amazing. They\'re awesome, and fuzzy, and cute. Who DOESN\'T love cats?','2020-03-17','catlover'),(3,'Dogs are the best.','So I saw a post the other day talking about cats. Now, I love cats. They\'re great. But here\'s the thing: dogs are just the best, okay? There\'s no question about it. That is all.','2020-03-19','doglover'),(4,'I am the night.','To all you lowly criminals out there, this is a warning to know I am watching. I am justice. I am righteousness. I am the NIGHT.','2020-03-24','batman'),(5,'Waka waka','waka waka waka waka waka waka waka waka waka waka waka waka waka waka waka waka','2020-03-31','pacman'),(6,'Who is this Bob guy?','Decided to start tracking down this mysterious human known as \'Bob.\' Who is Bob? What does he do? WHY does he do it? There is a lot of mystery surrounding this person, and I will be going into detail in future posts. Stay tuned!','2020-04-02','notbob'),(7,'Re: I love cats.','A reader recently reached out to me about my last post. To be clear, I\'m not dissing our canine companions! But we\'ve got to be honest here, why are cats better? They\'re smart, affectionate, and great cuddle partners. Cats are better. It\'s just fact.','2020-04-04','catlover'),(8,'Scooby Dooby Doo!','The search for scooby snacks: Where did they go? I know this whole quarantine thing is affecting businesses, but aren\'t scooby snacks counted as an essential service? Please post below if you find anything! I\'m going crazy here!','2020-04-05','scooby'),(9,'Bob Update','Dear readers, I know you have been waiting anxiously for an update on Bob, but there is not much to share so far. He appears to have little to no online presence. Just a clarification: I am decidedly NOT Bob. Thanks all. Stay tuned for more!','2020-04-06','notbob'),(10,'Lizard People.','What are your guys\' thoughts on them? I, for one, welcome out reptitlian overlords.','2020-04-12','jdoe');";

$blogTagsQuery = "INSERT INTO blogstags VALUES (1,'hello world'),(2,'animals'),(2,'cats'),(3,'animals'),(3,'dogs'),(4,'crime'),(4,'justice'),(5,'cartoon'),(5,'waka'),(6,'bob'),(6,'update'),(7,'cats'),(7,'dogs'),(8,'dogs'),(8,'quarantine'),(8,'scooby snacks'),(9,'bob'),(9,'update'),(10,'lizards');";

$commentsQuery = "INSERT INTO comments VALUES (1,'negative','Cats are cool and all, but dogs are where it\'s at.','2020-03-17',2,'doglover'),(2,'negative','What\'s all the hype about? Cats are clearly superior.','2020-03-20',3,'catlover'),(3,'positive','Nice.','2020-03-20',4,'scooby'),(4,'positive','Who IS Bob? I can\'t wait to find out.','2020-04-02',6,'jsmith'),(5,'negative','I guess cat people just don\'t know what they\'re missing.','2020-04-05',7,'doglover'),(6,'positive','This is totally unrelated, but I just wanted to say I am a HUGE fan of yours. I love your work!','2020-04-05',8,'doglover'),(7,'positive','Have you checked out Dog-Mart? They\'ve got everything.','2020-04-06',8,'matty'),(8,'negative','I was hoping there\'d be more of an update. Sorry, Bob.','2020-04-07',9,'jsmith'),(9,'positive','I think they\'re all secretly cats. Open your eyes, sheeple!','2020-04-13',10,'doglover'),(10,'negative','Who? Me? Multimillionaire philanthropist of Arkham? A lizard person? Nope. Nothing to see here!','2020-04-15',10,'batman');";

$followsQuery  = "INSERT INTO follows VALUES ('jsmith','bob'),('batman','catlover'),('doglover','catlover'),('pacman','catlover'),('catlover','doglover'),('jsmith','jdoe'),('bob','notbob'),('jdoe','notbob'),('batman','pacman'),('scooby','pacman'),('doglover','scooby'),('pacman','scooby');";

$hobbiesQuery = "INSERT INTO hobbies VALUES ('batman','movie'),('bob','movie'),('catlover','movie'),('doglover','hiking'),('jdoe','dancing'),('jdoe','movie'),('jsmith','hiking'),('matty','bowling'),('notbob','calligraphy'),('pacman','dancing'),('pacman','movie'),('scooby','cooking');";



$insert = [$userQuery, $blogQuery, $blogTagsQuery, $commentsQuery, $followsQuery, $hobbiesQuery];



foreach($insert as $k => $sql)

{

        

        mysqli_query($con, $sql);

}





header('Location: home.php');
