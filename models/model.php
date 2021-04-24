<?php

class ModelDanych{

 public $filename= "models/database.db";
 public $db;

public function __construct(){
    if ($db = new SQLite3($this->filename)) {
        //$query = "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, tresc text);";
        $query= "pragma foreign_key = on";
        $queryid = $db->query($query);
        $query = "

        CREATE TABLE IF NOT EXISTS Characters (
            `Character` VARCHAR(45) NOT NULL PRIMARY KEY,
            `Class` VARCHAR(45) NULL,
            `Level` INT NULL,
            `XP` BIGINT NULL,
            `Profession1` VARCHAR(45) NULL,
            `Profession2` VARCHAR(45) NULL
        );";
        $queryid = $db->query($query);
        $query = "
        CREATE TABLE IF NOT EXISTS Forum (
            `ForumNickname` VARCHAR(45) NOT NULL PRIMARY KEY,
            `Character` VARCHAR(45) NULL,
            `Posts` INT NULL,
            `ForumRank` VARCHAR(45) NULL,
            FOREIGN KEY (
                Character
            )
            REFERENCES Characters (Character) ON UPDATE CASCADE
                                               ON DELETE CASCADE
            );";
        $queryid = $db->query($query);
        $query= "
        CREATE TABLE IF NOT EXISTS Users (
            `Username` VARCHAR(45) NOT NULL,
            `Email` VARCHAR(45) NOT NULL,
            `DonateCoins` INT NOT NULL,
            `ForumNickname` VARCHAR(45) NOT NULL,
            `Character` VARCHAR(45) NOT NULL,
            FOREIGN KEY (
                ForumNickname
            )
            REFERENCES Forum (ForumNickname) ON UPDATE CASCADE
                                              ON DELETE CASCADE
            FOREIGN KEY (
                 Character
            )
            REFERENCES Characters (Character) ON UPDATE CASCADE
                                              ON DELETE CASCADE                                             
                                
                                            );    
                          ";
            $queryid = $db->query($query);
            /*
            $query = "
            INSERT INTO Characters (Character, Class, Level, XP, Profession1, Profession2)
            VALUES('Leonidas', 'Wojownik', 5, 500, 'Mining', 'Fishing');
             ";
             
            $queryid = $db->query($query);
            */
    }
    $this->db = $db;
}

public function pobierz($page){
    $filename= "models/database.db";

    switch($page){

        case 'mainpage':
        case 'create':
            if(isset($_POST['submit'])){
                $username = ucfirst($_POST['Username']);
                $email = ucfirst($_POST['Email']);
                $forum = ucfirst($_POST['ForumNickname']);
                $character = ucfirst($_POST['Character']);
                $class = ucfirst($_POST['Class']);
                $prof1 = ucfirst($_POST['Profession1']);
                $prof2 = ucfirst($_POST['Profession2']);


                $create= "INSERT INTO Characters(Character, Class, Level, XP, Profession1, Profession2)
                VALUES ('$character','$class',1,0,'$prof1','$prof2')";
                $queryid = $this->db->query($create);

                $create= "INSERT INTO Forum(ForumNickname, Character, Posts, ForumRank)
                VALUES ('$forum','$character',0,'New')";
                $queryid = $this->db->query($create);

                $create= "INSERT INTO Users(Username, Email, DonateCoins, ForumNickname ,Character )
                VALUES ('$username','$email',0,'$forum', '$character')";
                $queryid = $this->db->query($create);
                
            }
            
            break;
        case 'delete':
            $tresc= "
            <form action= '' method='POST'>
            &nbsp &nbsp&nbspType in character's name to delete the account: 
            <input type='text' name='delete'>
             </form>  
            ";
            if(isset($_POST['delete'])){
                $delete = $_POST['delete'];
                $query = "DELETE FROM Characters WHERE Character= '$delete'";
                $queryid = $this->db->query($query);
                $query = "DELETE FROM Forum WHERE Character= '$delete'";
                $queryid = $this->db->query($query);
                $query = "DELETE FROM Users WHERE Character= '$delete'";
                $queryid = $this->db->query($query);
                $tresc.= "<br><h1>Usunieto $delete </h1><br>";
            
            }
            return $tresc;
            break;
            
        case 'update':
            $tresc ="
            <form action= '' method='POST'>
            &nbsp &nbsp &nbspType in the Character's name: 
                <input type='text' name='search'>
            </form>    
            <br>

            ";
            if(isset($_POST['search'])){
                $search = $_POST['search'];
                $query= "SELECT * FROM users WHERE Character LIKE '$search'";
                
                $queryid = $this->db->query($query);
                if (!$queryid) die('Błąd odczytu z bazy danych: ' . lastErrorCode($this->db));
        
                        $row = $queryid->fetchArray();

                $query= "SELECT * FROM Characters WHERE Character IS '$search'";
                $queryid = $this->db->query($query);
                if (!$queryid) die('Błąd odczytu z bazy danych: ' . lastErrorCode($this->db));
        
                $row = $queryid->fetchArray();

                $query= "SELECT * FROM Forum WHERE Character IS '$search'";
                $queryid = $this->db->query($query);
                if (!$queryid) die('Błąd odczytu z bazy danych: ' . lastErrorCode($this->db));
        
                        $row = $queryid->fetchArray();
                 /*       
                            $posts=$row['Posts'];
                            $rank=$row['ForumRank'];
                     */   
                $tresc.='<br>
                Character: '.$search.'     
                <form action="?page=update&search='.$search.'" method="post">
                    General:
                    <input type="text" name="Username" placeholder="Username" />
                    <input type="text" name="Email" placeholder="E-mail" />
                    <input type="text" name="DonateCoins" placeholder="DonateCoins" />

                    <br>Forum:
                    <input type="text" name="ForumNickname" placeholder="ForumNickname" />
                    <input type="text" name="Posts" placeholder="Posts" />
                    <input type="text" name="ForumRank" placeholder="ForumRank" />

                    <br>Character:
                    <input type="text" name="Character" placeholder="Character" />
                    <input type="text" name="Class" placeholder="Class" />
                    <input type="text" name="Level" placeholder="Level" />
                    <input type="text" name="XP" placeholder="XP" />
                    <input type="text" name="Profession1" placeholder="Profession1" />
                    <input type="text" name="Profession2" placeholder="Profession2" />
                    <input type="submit" name="update" value="Update" />
                </form> 
                ';
            }
            if(isset($_POST['update'])){
                $search = $_GET['search'];

                $username = $_POST['Username'];
                $email = $_POST['Email'];
                $donate = $_POST['DonateCoins'];
                $forum = $_POST['ForumNickname'];
                $posts = $_POST['Posts'];
                $rank = $_POST['ForumRank'];
                $character = $_POST['Character'];
                $class = $_POST['Class'];
                $lvl = $_POST['Level'];
                $xp = $_POST['XP'];
                $prof1 = $_POST['Profession1'];
                $prof2 = $_POST['Profession2'];


                if($username != ""){
                    $query = "UPDATE Users SET Username = '$username' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($email != ""){
                    $query = "UPDATE Users SET Email = '$email' WHERE Character = '$email';";           
                    $queryid = $this->db->query($query);}
                if($donate != ""){
                    $query = "UPDATE Users SET DonateCoins = '$donate' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($forum != ""){
                    $query = "UPDATE Forum SET ForumNickname = '$forum' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);
                    $query = "UPDATE Users SET ForumNickname = '$forum' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);
                    $query = "UPDATE Characters SET ForumNickname = '$forum' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($posts != ""){
                    $query = "UPDATE Forum SET Posts = '$posts' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($rank != ""){
                    $query = "UPDATE Forum SET ForumRank = '$rank' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($character != ""){
                    $query = "UPDATE Characters SET Character = '$character' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);
                    $query = "UPDATE Users SET Character = '$character' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);
                    $query = "UPDATE Forum SET Character = '$character' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($class != ""){
                    $query = "UPDATE Characters SET Class = '$class' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($lvl != ""){
                    $query = "UPDATE Characters SET Level = '$lvl' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($xp != ""){
                    $query = "UPDATE Characters SET XP = '$xp' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($prof1 != ""){
                    $query = "UPDATE Characters SET Profession1 = '$prof1' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                if($prof2 != ""){
                    $query = "UPDATE Characters SET Profession2 = '$prof2' WHERE Character = '$search';";           
                    $queryid = $this->db->query($query);}
                $tresc.="&nbsp&nbsp&nbsp&nbsp&nbsp";
                $tresc.=$search;
                $tresc.=" Updated";
            }
        

            return $tresc;
            break;
        case 'read':

            if(isset($_POST['table']) or isset($_GET['table'])){
                if(isset($_POST['table'])){
                    $table=$_POST['table'];
                }
                else if(isset($_GET['table']))
                {
                    $table=$_GET['table'];
                }
                

                if(isset($_POST['search'])){
                    $search=$_POST['search'];
                    if($_POST['search']=='')
                    {
                        $query= "SELECT * FROM $table";
                    }
                    else{
                        $query= "SELECT * FROM $table WHERE Character LIKE '$search'";
                    }
                    
                }
                else($query = "SELECT * FROM $table");
    
                
                $queryid = $this->db->query($query);
                if (!$queryid) die('Błąd odczytu z bazy danych: ' . lastErrorCode($this->db));
                
                $action = "?page=read&table=$table";

                $tresc ="<h1>Table: $table<h1>
                <form action= $action method='POST'>
                    Search by Character: 
                    <input type='text' name='search'>
                </form>    
                <br>
    
                ";
                
                switch($table){
                    case "Characters":
                        $tresc.="<table id= 'table1'><tr><th>Character</th><th>Class</th><th>Level</th><th>XP</th><th>Profession1</th><th>Profession2</th></tr>";
                        while($row = $queryid->fetchArray())
                        {
                            $tresc.="<tr><td>";
                            
                                $tresc.=$row['Character'];$tresc.="</td><td>";
                                $tresc.=$row['Class'];$tresc.="</td><td>";
                                $tresc.=$row['Level'];$tresc.="</td><td>";
                                $tresc.=$row['XP'];$tresc.="</td><td>";
                                $tresc.=$row['Profession1'];$tresc.="</td><td>";
                                $tresc.=$row['Profession2'];$tresc.="</td></tr>";
    
                        }
                        break;
                    case "Forum":
                        $tresc.="<table id ='table2'><tr><th>ForumNickname</th><th>Character</th><th>Posts</th><th>Forum rank</th></tr>";
                        while($row = $queryid->fetchArray())
                        {
                            $tresc.="<tr><td>";
                            
                                $tresc.=$row['ForumNickname'];$tresc.="</td><td>";
                                $tresc.=$row['Character'];$tresc.="</td><td>";
                                $tresc.=$row['Posts'];$tresc.="</td><td>";
                                $tresc.=$row['ForumRank'];$tresc.="</td></tr>";
    
                        }
                        break;
                    case "Users":
                        $tresc.="<table id ='table3'><tr><th>Username</th><th>Email</th><th>DonateCoins</th><th>ForumNickname</th><th>Character</th></tr>";
                        while($row = $queryid->fetchArray())
                        {   
                            $tresc.="<tr><td>";
                            $tresc.=$row['Username'];$tresc.="</td><td>";
                            $tresc.=$row['Email'];$tresc.="</td><td>";
                            $tresc.=$row['DonateCoins'];$tresc.="</td><td>";
                            $tresc.=$row['ForumNickname'];$tresc.="</td><td>";
                            $tresc.=$row['Character'];$tresc.="</td></tr>";
                        }
                        break;
                }
                
                $tresc.="</table>";
                return $tresc;
            }
            else{
                $tresc= "&nbsp&nbsp&nbsp&nbspChoose the table first";
                return $tresc;
            }


        case 'create':
            $plik = fopen("models/settings.txt", 'r');
            $tresc = fread($plik,filesize("models/settings.txt"));
            return $tresc;
        default:
            break;
        break;
    }
}

public function zapisz($tresc){

	$tresc = trim(strip_tags($tresc));
	$plik = fopen("models/settings.txt", 'w');
	fwrite($plik,$tresc);
	fclose($plik);

}


}
?>