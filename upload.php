<?php
if (isset($_POST["submit"])) {
    $db = new mysqli('localhost', 'root', '(WC0zSyecb.Z@uFi', 'remember');
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $imageData = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    $imageName = $_FILES["fileToUpload"]["name"];
    $tag =$_POST["tag"];

    $sql = "INSERT INTO images (photo,tag,filesname) VALUES (?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss", $imageData,$tag,$imageName);

    if ($stmt->execute()) {
        echo "Image uploaded to the database successfully.";
    } else {
        echo "Error uploading image: " . $stmt->error;
    }

    $stmt->close();
    $db->close();
}
?>
