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
    
    <main>  
        <h1>Delete</h1>
        <h2>Type in account's character<br>To delete record</h2>
    </main>
    
    <?php
    echo("<div id='tresc'><h3>$tresc</h3></div>");
    ?>

</body>
</html>
