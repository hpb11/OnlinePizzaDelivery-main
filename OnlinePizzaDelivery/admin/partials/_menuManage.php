<?php
include '_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['createItem'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $categoryId = $_POST["categoryId"];
        $price = $_POST["price"];

        $sql = "INSERT INTO `pizza` (`pizzaName`, `pizzaPrice`, `pizzaDesc`, `pizzaCategorieId`, `pizzaPubDate`) VALUES ('$name', '$price', '$description', '$categoryId', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $pizzaId = $conn->insert_id;
        if ($result) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {

                $newName = 'pizza-' . $pizzaId;
                $newfilename = $newName . ".jpg";
            
                if ( copy($_FILES['image']['tmp_name'], "file:///C:/xampp/htdocs/OnlinePizzaDelivery-main/OnlinePizzaDelivery/img/pizza-" . $pizzaId . ".jpg") && move_uploaded_file($_FILES['image']['tmp_name'], "file:///C:/xampp/htdocs/OnlinePizzaDelivery-main/OnlinePizzaDelivery/admin/assetsForSideBar/img/pizza-" . $pizzaId . ".jpg")) {
                    echo "<script>alert('success');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('failed');
                            window.location=document.referrer;
                        </script>";
                }
            } else {
                echo '<script>alert("Please select an image file to upload.");
                        window.location=document.referrer;
                    </script>';
            }
        } else {
            echo "<script>alert('failed 2');
                    window.location=document.referrer;
                </script>";
        }
    }

    if (isset($_POST['removeItem'])) {
        $pizzaId = $_POST["pizzaId"];
        $sql = "DELETE FROM `pizza` WHERE `pizzaId`='$pizzaId'";
        $result = mysqli_query($conn, $sql);
        $filename1 = "file:///C:/xampp/htdocs/OnlinePizzaDelivery-main/OnlinePizzaDelivery/admin/assetsForSideBar/img/pizza-" . $pizzaId . ".jpg";
        $filename2 = "file:///C:/xampp/htdocs/OnlinePizzaDelivery-main/OnlinePizzaDelivery/img/pizza-" . $pizzaId . ".jpg";
        if ($result) {
            if (file_exists($filename1)) {
                unlink($filename1);
            }
            if (file_exists($filename2)) {
                unlink($filename2);
            }
            echo "<script>alert('Removed');
                window.location=document.referrer;
            </script>";
        } else {
            echo "<script>alert('failed');
            window.location=document.referrer;
            </script>";
        }
    }
    if (isset($_POST['updateItem'])) {
        $pizzaId = $_POST["pizzaId"];
        $pizzaName = $_POST["name"];
        $pizzaDesc = $_POST["desc"];
        $pizzaPrice = $_POST["price"];
        $pizzaCategorieId = $_POST["catId"];

        $sql = "UPDATE `pizza` SET `pizzaName`='$pizzaName', `pizzaPrice`='$pizzaPrice', `pizzaDesc`='$pizzaDesc', `pizzaCategorieId`='$pizzaCategorieId' WHERE `pizzaId`='$pizzaId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('update');
                window.location=document.referrer;
                </script>";
        } else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    if (isset($_POST['updateItemPhoto'])) {
        $pizzaId = $_POST["pizzaId"];
        $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
        if ($check !== false) {
            $newName = 'pizza-' . $pizzaId;
            $newfilename = $newName . ".jpg";

            if ( copy($_FILES['image']['tmp_name'], "file:///C:/xampp/htdocs/OnlinePizzaDelivery-main/OnlinePizzaDelivery/img/pizza-" . $pizzaId . ".jpg") && move_uploaded_file($_FILES['image']['tmp_name'], "file:///C:/xampp/htdocs/OnlinePizzaDelivery-main/OnlinePizzaDelivery/admin/assetsForSideBar/img//pizza-" . $pizzaId . ".jpg")) {
                echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('failed');
                        window.location=document.referrer;
                    </script>";
            }
        } else {
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
}
