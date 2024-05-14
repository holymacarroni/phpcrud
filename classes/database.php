<?php
 

class database
{
    function opencon()
    {
       
        return new PDO('mysql:host=localhost;dbname=phpoop_221', 'root', '');
    }
 
    // CHECK FUNCTION
    function check($username, $password)
    {
        $con = $this->opencon();
   
        $query = "SELECT * FROM users WHERE username = '" . $username . "' && pass = '" . $password . "'";
        return $con->query($query)->fetch();
    }

 
     // CHECK FUNCTION
    function signup($firstname,$lastname,$birthday,$gender,$username,$password){
        $con = $this->opencon();
   
        $query = $con->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
 
        // If the username already exists, return false
        if ($existingUser) {
            return false;
        }
 
        return $con->prepare("INSERT INTO users (Firstname,LastName,birthday,gender,user, password) VALUES (?,?,?,?,?,?)")->execute([$firstname,$lastname,$birthday,$gender,$username,$password]);
    }
 
    function signupUser($firstname,$lastname,$birthday,$gender,$username,$password){
        $con = $this->opencon();
   
        $query = $con->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
 
        if ($existingUser) {
            return false;
        }
 
        $con->prepare("INSERT INTO users (FirstName,LastName,birthday,gender,username, pass) VALUES (?,?,?,?,?,?)")->execute([$firstname,$lastname,$birthday,$gender,$username,$password]);
        return $con->lastInsertId();
    }
 
    function insertAddress($user_id,$street,$barangay,$city,$province){
        $con = $this->opencon();
 
       return $con->prepare("INSERT INTO user_address (user_id,user_street,user_barangay,user_city,user_province) VALUES (?,?,?,?,?)")->execute([$user_id,$street,$barangay,$city,$province]);
    }
       function view() {
        $con = $this->opencon();
        $query = $con->prepare('    ');
        return $con-> query("SELECT users.user_id, users.FirstName, users.LastName, users.Birthday,users.Gender, users.username, CONCAT(user_address.user_street,' ', user_address.user_barangay,' ', user_address.user_city,' ', user_address.user_province) AS address FROM users INNER JOIN user_address ON users.user_id = user_address.user_id; ")->fetchALL();
    }
    function delete($id) {
        try
        { $con = $this->opencon();
            $con->beginTransaction();

            //Delete user address
            $query = $con->prepare("DELETE FROM user_address WHERE user_id=?");
            $query->execute([$id]);

            $query2 = $con->prepare("DELETE FROM users WHERE user_id=?");
            $query2->execute([$id]);

            $con->commit();
            return true; //Deletion Sucessful
        } catch (PDOException $e) {
            $con->rollBack();
            return false;
}

    }
   
    function viewdata($id){
        try
        { $con = $this->opencon();
            $query = $con->prepare("SELECT users.user_id, users.FirstName, users.LastName, users.Birthday,users.Gender, users.username, users.pass,  user_address.user_street, user_address.user_barangay, user_address.user_city, user_address.user_province  FROM users INNER JOIN user_address ON users.user_id = user_address.user_id WHERE users.user_id=?");
            $query->execute([$id]);
            return $query ->fetch();
        } catch (PDOException $e) {
                return[];
           
        }
}
function updateUser($user_id,$firstname,$lastname,$birthday,$sex,$username,$password){
    try{
        $con = $this->opencon();
        $query = $con -> prepare("UPDATE users SET FirstName = ?, LastName = ?, Birthday = ?, Gender = ?, username = ?, pass = ? WHERE user_id = ?");
        return $query->execute([$firstname, $lastname, $birthday, $sex, $username, $password, $user_id]);
    } catch(PDOException $e) {
        return false;
    }
  }

  function updateUserAddress($user_id, $street, $barangay, $city, $province){
    try{
        $con = $this->opencon();
        $query = $con -> prepare("UPDATE user_address SET user_street = ?, user_barangay = ?, user_city = ?, user_province = ? WHERE user_id = ?");
        return $query->execute([$street, $barangay, $city, $province,$user_id]);
    } catch(PDOException $e) {
        $con -> rollBack();
        return false;

    }
  }
}

?>