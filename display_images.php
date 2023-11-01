<!DOCTYPE html>
<html>
<head>
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .gallery img {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 5px #888;
        }
    </style>
</head>
<body>
    <div class="gallery">
        <?php
        $db = new mysqli('localhost', 'root', '(WC0zSyecb.Z@uFi', 'remember');
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        $sql = "SELECT filesname, photo FROM images ORDER BY time DESC";

        $result = $db->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $imageData = $row['photo'];
                $imageName = $row['filesname'];
                echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="' . $imageName . '">';
            }
        } else {
            echo "Error fetching images: " . $db->error;
        }

        $db->close();
        ?>
    </div>
</body>
</html>
