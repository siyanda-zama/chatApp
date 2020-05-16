<?php

class Chat
{ 

    public $host = '127.0.0.1';
    public $dbName = 'dbChat';
    public $uname = 'root';
    public $upass = '';
    protected $con;

    # get connection
    public function getConnection()
    {
        $this->con = null;
        try
        {

            $this->con = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->uname,$this->upass);
            
        }catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
        return $this->con;
    }


    # close connection
    public function clsConnection()
    {
        return $this->con = null;
    }

    #login
    function userLogin($number,$password)
    {
        try{
            $db = $this->getConnection();
            $query = 'call sp_validateLogin(?,?)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $number);
            $stmt->bindParam(2, $password);
            if($stmt->execute())
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['aMsg'];
            }
            $db = $this->clsConnection();
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    #get message senders
    function getSenders($number)
    {
        try
        {
            $db = $this->getConnection();
            $query = 'CALL sp_getSenders(?)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$number);
            $stmt->execute();
            return $stmt;
            $db = $this->clsConnection();
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    # get messages
    function getMsgs($number,$reciever)
    {
        try
        {
            $db = $this->getConnection();
            $query = 'CALL sp_getMsgs(?,?)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$number);
            $stmt->bindParam(2,$reciever);
            $stmt->execute();
            return $stmt;
            $db = $this->clsConnection();
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    # send message
    function sendMsg($number,$reciever,$msg)
    {
        try
        {
            $db = $this->getConnection();
            $query = 'CALL pi_sendMsg(?,?,?)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$number);
            $stmt->bindParam(2,$reciever);
            $stmt->bindParam(3,$msg);
            if($stmt->execute())
            {
                return true;
            } 
            $db = $this->clsConnection();
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }   
    }

    # get first sender
    function getFirstSender($number)
    {
        try
        {
            $db = $this->getConnection();
            $query = 'CALL sp_getFirstSender(?)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$number);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['sender_name'];
            $db = $this->clsConnection();
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage(); 
        }   
    }


}