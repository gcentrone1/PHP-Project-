<?php
require_once('connection.php');
require_once('model/user.php');

function verifyLogin($email, $password, $token){

    
    $result = [
        'message' => 'USERD LOGGED IN',
        'success' => true

    ];
    if ($token !== $_SESSION['csrf']) {
        $result = [
            'message' => 'TOKEN MISMATCH',
            'success' => false

        ];
        return $result;
    }
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $result = [
            'message' => 'WRONG EMAIL',
            'success' => false

        ];
        return $result;
    }
    if (strlen($password) < 6) {
        $result = [
            'message' => 'PASSWORD TOO SMALL',
            'success' => false

        ];
        return $result;
    }
    $resEmail = getUserByEmail($email);
    if (!$resEmail) {
        $result = [
            'message' => 'USER NOT FOUND',
            'success' => false

        ];
        return $result;
    }
print_r($password, $resEmail['password']);die;
    if (!password_verify($password, $resEmail['password'])) {
        $result = [
            'message' => 'WRONG PASSWORD',
            'success' => false

        ];
        return $result;
    }
    $result['user'] = $resEmail;
    return $result;
}

function getConfig($param, $default = null)
{
    $config = require('congif.php');

    return array_key_exists($param, $config) ? $config[$param] : $default;
    //se esiste la chiave che stiamo passando attraverso confi nell'array confg ritornami quella altrimenti ritornami null 
    // ? significa into, nell'array mentre : vuol dire alse, altrimenti 
}
function getParam($param, $default = null)
{
    return !empty($_REQUEST[$param]) ? $_REQUEST[$param] : $default;
    //se c'è il parametro che sto cercando nella request ritorniamo il parametro altrimenti torniamo default che è stato pre impostato a null 

}
function getRandomName()
{
    $names = [
        'Gemma', 'Letizia', 'Gerry', 'Luca'

    ];
    $lastnames = [
        'Centrone', 'Sabadini', 'Di Venosa', 'Marcadent'
    ];
    $rand1 = mt_rand(0, count($names) - 1);  //mt_rand prende un numero intero casuale tra quelli inseriti mt_rand(1,99)
    $rand2 = mt_rand(0, count($lastnames) - 1);
    return $names[$rand1] . ' ' . $lastnames[$rand2];
} //genera nomi e cognomi random 


function getRandomEmail($names)
{
    $domain = [
        'google.it', 'yahoo.com', 'hotmail.com', 'live.it', 'gmail.com'

    ];
    $rand10 = mt_rand(0, count($domain) - 1);
    return $str = str_replace(' ', '.', $names) . mt_rand(10, 99) . '@' . $domain[$rand10];
    //str_replace -> che cosa, con che cosa e a che cosa quindi dove 
} //genera mail random dai nomi 


function getRandomFiscalcode()
{
    $i = 16;
    $res = ''; //dobbiamo generare delle lettere finchè non si arriva a 16 quindi verranno concatenate nella atringa vuota
    while ($i > 0) {

        $res .= chr(mt_rand(65, 90));
        $i--;
    }
    return $res;
}

function getRandomAge()
{
    return mt_rand(0, 120);
}

/* echo getRandonFiscalcode() .'<br>' ;
echo getRandomAge(); */

function insertRandomUser($totale, mysqli $conn)
{
    while ($totale > 0) {
        $username = getRandomName();
        $email = getRandomEmail($username);
        $fiscalcode = getRandomFiscalcode();
        $age = getRandomAge();
        $sql = 'INSERT INTO users (username, email, fiscalcode, age ) VALUES ';
        $sql .= " ('$username', '$email', '$fiscalcode', $age ) "; // tra apici perchè è una stringa 
        echo $totale . ' ' . $sql . '<br>';
        $res = $conn->query($sql);
        if (!$res) {
            echo $conn->error . '<br>'; //dice il numero di errore e l'errore che c'è stato 
        } else {
            $totale--;
        }
    }
}

//insertRandomUser(30, $mysqli); //30 

function getUsers(array $params = [])
{
    /*  $conn mysqli */
    $conn = $GLOBALS['mysqli'];
    $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'username';
    $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
    $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;

    $page = array_key_exists('page', $params) ? $params['page'] : 0;

    $start = $limit * ($page - 1);
    if ($start < 0) {
        $start = 0;
    }
    $search = array_key_exists('search', $params) ? $params['search'] : '';

    $search = $conn->escape_string($search); //si occupa di cercare esattamente la parola right 
    // qyesto sopra è un ternario-> verifico se c'è la chiave
    if ($orderDir !== 'ASC' && $orderDir !== 'DESC') {
        $orderDir = 'ASC';
    } // verifico se order dir è diverso da asc e da desc quindi è un valore non valido di deafult lo rendo uguale a ASc 
    $records = [];
    $sql = ' SELECT * FROM users ';
    if ($search) {
        $sql .= "WHERE username LIKE '%$search%' "; //qualunque cosa anche dopo
        $sql .= "OR fiscalcode LIKE '%$search%' ";
        $sql .= "OR email LIKE '%$search%' ";
        $sql .= "OR age LIKE '%$search%' ";
        $sql .= "OR id LIKE '%$search%' ";
    }
    $sql .= "ORDER BY $orderBy $orderDir LIMIT $start, $limit ";

    //echo $sql;

    $res = $conn->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) //mostra l'errore di un array
            $records[] = $row;
    } else {
        die($conn->error);
    }
    return $records;
}

function countUsers(array $params = [])
{
    /*  $conn mysqli */
    $conn = $GLOBALS['mysqli'];
    // verifico se order dir è diverso da asc e da desc quindi è un valore non valido di deafult lo rendo uguale a ASc 
    $total = 0;

    $sql = ' SELECT COUNT(*) as total FROM users ';



    $res = $conn->query($sql);
    if ($res) {
        $row = $res->fetch_assoc(); //mostra l'errore di un array
        $total = $row['total'];
    } else {
        die($conn->error);
    }
    return $total;
}
function isUserLoggedin() {
    return $_SESSION['loggedin'] ?? false;

}
function getUserLoggedInFullname(){
    return $_SESSION['userData']['username'] ?? '';
}
function getUserRole(){
    return $_SESSION['userData']['roletype'] ?? '';
}
