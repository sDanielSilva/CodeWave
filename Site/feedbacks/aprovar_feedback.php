<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idFeedback'])) {
    $idFeedback = $_POST['idFeedback'];

    try {
        $query = "UPDATE feedback SET status = NOT status WHERE id_feedback = :idFeedback";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':idFeedback', $idFeedback);
        $stmt->execute();
        echo "success";
    } catch (PDOException $e) {
        echo "error";
    }
} else {
    echo "error";
}
?>
