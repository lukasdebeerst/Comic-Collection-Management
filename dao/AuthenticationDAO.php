<?php 

require_once __DIR__ . '/DAO.php';

class AuthenticationDAO extends DAO {

    public function checkLogin($mail){
        $sql = "SELECT * FROM `authentication` WHERE `mail` = :mail ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(){
        $sql = "SELECT * FROM `authentication`";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id){
        $sql = "SELECT * FROM `authentication` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function changeUserName($data){
        $sql = "UPDATE `authentication` SET `firstName` = :firstName, `lastName` = :lastName WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':firstName', $data['firstName']);
        $stmt->bindValue(':lastName', $data['lastName']);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();
    }

    public function changeUserStatus($data){
        $sql = "UPDATE `authentication` SET `status` = :status WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':status', $data['status']);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();
    }

    public function changeUserMail($data){
        $sql = "UPDATE `authentication` SET `mail` = :mail WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':mail', $data['mail']);
        $stmt->bindValue(':id', $data['id']);
        $stmt->execute();
    }

    public function changeUserPassword($password, $id) {
        $sql = "UPDATE `authentication` SET `password` = :password WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function createNewUser($password, $data){
        $sql = "INSERT INTO `authentication` (`firstName`, `lastName`, `mail`, `password`, `status`) VALUES (:firstName, :lastName, :mail, :password, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':firstName', $data['firstName']);
        $stmt->bindValue(':lastName', $data['lastName']);
        $stmt->bindValue(':mail', $data['mail']);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':status', $data['status']);
        $stmt->execute();
    }

    public function deleteUser($id){
        $sql = "DELETE FROM `authentication` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function checkMail($mail){
        $sql = "SELECT * FROM `authentication` WHERE `mail` = :mail";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}


?>