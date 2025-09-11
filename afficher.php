<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT logo FROM association WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($logo);
        $stmt->fetch();

        if (!empty($logo)) {
            header("Content-Type: image/jpeg"); // Or PNG later
            echo $logo;
            exit();
        }
    }
}

http_response_code(404); // Not found
echo "Logo introuvable.";
?>
