<?php
    session_start();
    if(isset($_SESSION['username'])){
        //dia chi của show luu tru o day
        header("Location:");
    }
    if($_SERVER['REQUEST_METHOD']==='POST')
    {
        //dia chi cua file trong dao
        include "";
        $db = new Database();
        if(isset($_POST['username'])&&isset($_POST['password']))
        {
            if(ctype_alnum($_POST['username']) && ctype_alnum($_POST['password'])){
                if(isset($_POST['Login'])){
                    $query="select * from account where username=? and password=?";
                    $param=[
                        $_POST['username'],
                        $_POST['password']
                    ];
                    $stmt=$db->EditDataParam($query, $param);
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    if($row['password']===$_POST['password']){
                        $_SESSION['username']=$_POST['username'];
                        $_SESSION['login']="Login";
                        //dia chi cua show luu tru de o day
                        header("Location:");
                    }else{
                        Message::ShowMessage("wrong password or username");
                    }
                }
                if(isset($_POST['Register'])){
                    $_SESSION['Register']="Register";
                    //dia chi cua page register
                    header("Location:");
                }
            }else{
                Message::ShowMessage("special letters are not allowed");
            }

        }else{
            Message::ShowMessage("password or username not filled yet");
        }
        $db->CloseConn();
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link type="text/css" rel="stylesheet" href="css/Login.css"/>
</head>
<body>
    <form method="post">
        <div class="container">
            <label for="username">username</label>
            <input type="text" name="username" id="username"><br/>
            <label for="password">password</label>
            <input type="text" name="password" id="password"><br/>
            <input type="submit" name="Login" value="Login">
            <input type="submit" name="Register" value="Register">
        </div>
    </form>
</body>
</html>