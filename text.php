


$user = unserialize($_SESSION['user']);<?php
require_once("users.php");
require_once("document.php");
class Database
{
    private $mysqli;

    /* 
        <meta http-equiv="refresh" content="10">

    */

    public function __construct($host, $user, $password, $table)
    {
        $this->mysqli = new mysqli($host, $user, $password, $table);
        if ($this->mysqli->connect_errno)
        {
            echo " db connect failed", $this->mysqli->connect_error;
            die();
        }

    }

    public function insertUser($user)
    {
        $checkUserExist = $this->getUser($user->email);
        if($checkUserExist->userId != "")
        {
            echo "User exist Already insert";
            return new User();
        }
        $passwordHash = password_hash($user->password, PASSWORD_DEFAULT);
        $statemant = "INSERT INTO `user`(`password`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `KURS`, `ROLE`) VALUES ('$passwordHash', '$user->email','$user->firstName','$user->lastName','$user->kurs', '$user->role')";
        $result = mysqli_query($this->mysqli, $statemant);
        echo $result;
        return $this->getUser($user->email);

    }

    public function updateUser($user)
    {
        $checkUserExist = $this->getUser($user->email);
        if($checkUserExist->userId == "")
        {
            echo "User  not exist";
            return new User();
        }
       
        $statement = "UPDATE t_user SET firstname = '$user->firstname' , lastname = '$user->lastname' , kurs = '$user->kurs'  WHERE id = '$user->id'";
        // Execute query and returns the result
        return $this->mysqli->query($statement);

    }

    public function getUser($email)
    {
        $statemant = "SELECT * FROM `user` WHERE `EMAIL` = '$email';";
        $result = mysqli_query($this->mysqli, $statemant);
        $sqlResult = mysqli_fetch_array($result);
        $newUser = new User(); 
        echo $statemant;
        if(count($sqlResult)> 1)
        {
            $newUser->userId = $sqlResult['USERID'];
            $newUser->email = $sqlResult['EMAIL'];
            $newUser->password = $sqlResult['password'];
            $newUser->firstName = $sqlResult['FIRSTNAME'];
            $newUser->lastName = $sqlResult['LASTNAME'];
            $newUser->kurs = $sqlResult['KURS'];
            $newUser->role = $sqlResult['ROLE'];
            $newUser->time = $sqlResult['CREATTIME'];
        }
        else
        {
            echo "User not Found";
            return new User();
        }
        return $newUser;

    }

    public function login($user)
    {
        $checkUser = $this->getUser($user->email);
        if($checkUser->uderId != "")
        {
            echo "User dont exist";
            return new User();
        }

        if(password_verify($user->password,$checkUser->password))
        {
            return $checkUser;
        }

        return new User();

    }

 
  
  public function getDatabase()
  {
    return $this->mysqli;
  }



  public function getDocument($coursId)
  {
    $statement = "SELECT * FROM `t_document` t where t.course_id =   '$coursId' ;";
    $result = mysqli_query($this->mysqli, $statement);
    $sqlResult = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $kurse = array();

    echo $statement," <br>";

      foreach ($sqlResult as & $result) {
        echo "iam doc -> foreach";

        $kurs = new Kurs();
        $kurs->documentId = $result['document_id'];
        $kurs->courseId = $result['course_id'];
        $kurs->path = $result['path'];
        $kurs->displayName = $result['display_name'];
        array_push($kurse, $kurs);
      }
      // Creates an new user
      echo "iam Here start get user if <br>";

      return $kurse;
  }

  public function getAllUser($email) // aded with roles
  {
    $check = false;

    $statemant = "SELECT * FROM t_user ";
    $listUser = array();
    $querry = mysqli_query($this->mysqli, $statemant);
    $querryAll = mysqli_fetch_all($querry, MYSQLI_ASSOC);
    echo $querry;
    echo $querryAll;


    foreach ($querryAll as $result) {
      $newUser = new User();
      $newUser->userId = $result['user_id'];
      $newUser->courseId = $result['course_id'];
      $newUser->password = $result['password'];
      $newUser->firstname = $result['firstname'];
      $newUser->lastname = $result['lastname'];
      $newUser->postalCode = $result['postal_code'];
      $newUser->city = $result['city'];
      $newUser->street = $result['street'];
      $newUser->createdTime = $result['created_at'];
      $newUser->userRole = $result['user_role'];
      $newUser->email = $result['email'];
      array_push($listUser, $newUser);
    }
    return $listUser;
}

}
?>
