


$user = unserialize($_SESSION['user']);
$_SESSION['user'] = serialize($user);
        header("Location: ./t.php", true, 301);
if (isset($_GET['login'])) {

<form action="?register=1" method="post">


private $mysqli;
    
    public function __construct($host, $dbname, $user, $password) {
        
        $this->mysqli = new mysqli($host, $user, $password, $dbname);
        if ($this->mysqli->connect_errno) {
           echo . $this->mysqli->connect_error;
        }
    }
    public function getDatabase() {
        return $this->mysqli;
    }


    ct user 
    return $this->mysqli->query($statement);


    password_hash| password_verify

    $R = mysqli_query($this->mysqli, $statement);
        $allR = mysqli_fetch_array($result, MYSQLI_ASSOC);



 display: flex
 ="flex-grow: 1;"


{
    margin: 0;
    padding: 5px;
    list-style-type: none;
    text-align: center;
    background-color: #000;
}

{
    display: inline;
}

 {
    text-decoration: none;
    padding: .2em 1em;
    color: #fff;
    background-color: #000;
}

:hover {
    color: #000;
    background-color: #fff;
}