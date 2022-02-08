<?php

function delete(int $id)
{

    /**
     * @var $conn mysqli
     */
    $conn = $GLOBALS['mysqli'];

    $sql = 'DELETE FROM users WHERE id =' . $id;

    $res = $conn->query($sql);
    return $res && $conn->affected_rows;
}
function getUser(int $id)
{

    /**
     * @var $conn mysqli
     */
    $conn = $GLOBALS['mysqli'];
    $result = [];
    $sql = 'SELECT *  FROM users WHERE id =' . $id;
    // echo $sql;

    $res = $conn->query($sql);
    if ($res && $res->num_rows) {
        $result = $res->fetch_assoc();
    } else {
        die($conn->error);
    }
    return  $result;
}
function getUserByEmail(string $email)
{

    /**
     * @var $conn mysqli
     */
    $conn = $GLOBALS['mysqli'];
    $result = [];
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if(!$email){
        return $result;
    }
    $email =mysqli_escape_string($conn, $email);
    $sql = "SELECT *  FROM users WHERE email =' . '$email' ";
    // echo $sql;

    $res = $conn->query($sql);
    if ($res && $res->num_rows) {
        $result = $res->fetch_assoc();
    } else {
        die($conn->error);
    }
    return  $result;
}

function storeUser(array $data, int $id)
{

    /**
     * @var $conn mysqli
     */
    $result = [
        'success' => 1,
        'affectedRows' => 0,
        'error' => -1
    ];
    $conn = $GLOBALS['mysqli'];
    $username = $conn->escape_string($data['username']);
    $email = $conn->escape_string($data['email']);
    $fiscalcode = $conn->escape_string($data['fiscalcode']);
    $age = $conn->escape_string($data['age']);
    
    $roletype = in_array($data['roletype'], getConfig('roletypes', []))? $data['roletype'] : 'user' ;

    $sql = 'UPDATE users SET ';
    
    $sql .= "username='$username', email='$email',fiscalcode='$fiscalcode',";
    
    $sql .= "age=$age";
    if($data['password']){
        $data['password'] = $data['password'] ?? 'testuser';
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql .= ", password = '$password'";
    }
    if($data['roletype']){
        $roletype = in_array($data['roletype'], getConfig('roletypes', []))? $data['roletype'] : 'user' ;
        $sql .= ", roletype = '$roletype'";

    }
    $sql .= ' WHERE id =' . $id;
    print_r($data);
    echo $sql;die;


    $res = $conn->query($sql);
    if ($res) {
        $result['affectedRows'] = $conn->affected_rows;
    } else {
        $result['success'] = false;
        $result['error'] = $conn -> error;
    }
    return  $result;
}

function saveUser(array $data)
{

    /**
     * @var $conn mysqli
     */
   
    $conn = $GLOBALS['mysqli'];
    $username = $conn->escape_string($data['username']);
    $email = $conn->escape_string($data['email']);
    $fiscalcode = $conn->escape_string($data['fiscalcode']);
    $age = (int)$data['age'];
    $data['password'] = $data['password'] ?? 'testuser' ;
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
  
    $roletype = in_array($data['roletype'], getConfig('roletypes', []))? $data['roletype'] : 'user' ;

    $sql = 'INSERT INTO users (username, email, fiscalcode,age, password , roletype) ';
    $sql .= " VALUE('$username', '$email','$fiscalcode',$age, '$password', '$roletype')";
    //echo $sql;
    $res = $conn->query($sql);
    if ($res && $conn->affected_rows) {
        $result =  $conn->insert_id;
    } else {
        die($conn->error);
        $result =  -1;
    }
    return  $result;
}
