<!DOCTYPE html>
<html>
<head>
    <title>Forum</title>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="style.css" type="text/css">
 
</head>

<body>
    <header>
        <h1>Forum<img src="images/logo.png" alt=""> Database</h1>
        <nav>
            <ul>
                <li><a href="index.php?page=mainpage">Main Page</a>
                <li><a href="index.php?page=create">Create</a>
                <li><a href="index.php?page=read">Read</a>
                <li><a href="index.php?page=update">Update</a>
                <li><a href="index.php?page=delete">Delete</a>
            </ul>
        </nav>        
    </header>
    
    <main id ="create">  
        <h1>Create new account<br></h1>
        <div >
            <form action="" method="post">

            <input type="text" name="Username" placeholder="Username" />
            <input type="text" name="Email" placeholder="E-mail" />
            <input type="text" name="ForumNickname" placeholder="ForumNickname" />
            <br>
            <input type="text" name="Character" placeholder="Character" />
            <input type="text" name="Class" placeholder="Class" />
            <input type="text" name="Profession1" placeholder="Profession1" />
            <input type="text" name="Profession2" placeholder="Profession2" />
            <input type="submit" name="submit" value="Create" />
            </form> 
        </div>

    </main>
    


</body>
</html>
  
