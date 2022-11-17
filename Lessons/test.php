<?php
if (isset($_POST['isSubmitted'])) {
    echo $_FILES['imgFile']['name'];
    echo $_FILES['imgFile']['tmp_name'];

    $directory = "images/";
    // if (!is_dir($directory)) {
    //     echo mkdir($directory);
    // }

    $file = file_get_contents($_FILES["imgFile"]["tmp_name"]);

    $type = $_FILES["imgFile"]["type"];
    $type = explode("image/", $type);

    if (!file_exists("images/"."test.png")) {
        $dest = $directory."test.".$type[1];
        file_put_contents($dest, $file);

        // retrieve the directory of the inserted file somehow.
        // Perform an SQL Query here to insert the newly inserted file's directory into the database

        echo "<img src='$dest' width='20%' height='20%'>";

    }
}
?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="imgFile">
    <button name="isSubmitted" type="submit">Submit</button>
</form>