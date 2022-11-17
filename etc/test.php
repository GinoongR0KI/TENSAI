<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        
        <a href="../index.php">Go back to main page</a>

        <br/><br/><br/>

        <!-- Test -->
        <form method="POST" action="test2.php" enctype="multipart/form-data">
            <label><h2>Insert School Registration:</h2></label>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label>School ID:</label>
                        </td>
                        <td>
                        <input type="text" name="schoolID" placeholder="Insert Name Here" REQUIRED>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Template File:</label>
                        </td>
                        <td><input type="file" name="file" accept=".txt"></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <br/>
                            <input type="submit">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

    </body>
</html>