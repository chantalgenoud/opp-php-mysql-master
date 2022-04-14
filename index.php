<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php
        echo "Jupi, da kommt da kommt eine Übung für PHP, PHPMYADMIN und MYSQL";

        //Hier kommt die Datenbankverbindung (copy paste)

        //Prepare connection parameters.
        // getenv (string $varname, bool $local_only = false): string|false
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');

        // Connect to mySQL database using PHP PDO Object.
        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

        // TELL PDO to throw Exceptions for every error
        $dbConnection->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Ende Copy Paste

        // Hier kommt der Code für die Fragen mit subQuery

        // create a multidimensional array with questions Number 1 and holding the data
        $query = $dbConnection->query("SELECT ID, Text from Questions where ID = 1");

        //Hier kommt das Fetching (holen oder get)
        $questions = $query->fetchAll(PDO::FETCH_ASSOC);

        // Hier nehme ich die Antworten zur Frage mit ID = 1
        $subQuery = $dbConnection->prepare("SELECT Text from Answers where Question_ID = 1");
    
        // execute
        $subQuery->execute();

        //get all the rows received by the query and put them into the new variable $answers1
        $answers1 = $subQuery->fetchAll(PDO::FETCH_ASSOC);

        //create a new element answers1 in the $question-element and store the new array $answers1 in this element
        $questions['answers1'] = $answers1;
        ?>

        <div class = "container">
            <div class = "row">
                <div class = "col-sm-12">
                    <?php
                            //DevOnly: Print Output to see what is in the array $questions
                            print "<pre/>";
                            print_r($questions);
                            exit ();
                    ?>

                </div>
            </div>
    </div>


    
</body>
</html>