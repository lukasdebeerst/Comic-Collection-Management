<?php 

require_once __DIR__ . '/DAO.php';

class LogDAO extends DAO {

    public function newAction($userId, $action, $timestamp){
        $sql = "INSERT INTO `logfile` (`userId`, `sessionId`, `action`, `timestamp`) VALUES (:userId, :sessionId, :action, :timestamp)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':sessionId', $_SESSION['id']);
        $stmt->bindValue(':action', $action);
        $stmt->bindValue(':timestamp', $timestamp);
        $stmt->execute();
    }

}
?>