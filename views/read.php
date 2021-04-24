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
        <h1>Read</h1>
        <div id ="read">
            <form action="" method="post">
                <input type="submit" name="table" value="Characters" />
            </form>
            <form action="" method="post">
                <input type="submit" name="table" value="Forum" />
            </form>
            <form action="" method="post">
                <input type="submit" name="table" value="Users" />
            </form>
        </div>

    </main>
    <br>
    <?php
    echo("<div id='tresc'><h3>$tresc</h3></div>");
    ?>

    </body>
</html>

