<?php
if (empty($_SESSION['login']))
{
    if(!empty($_POST['email']) && !empty($_POST['pass'])){

    $sql= 'SELECT * FROM `users`
    WHERE `email`="'.$_POST['email'].'"
    AND `pass`="'.$_POST['pass'].'"';
    $user = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($user) == 1) 
        {
            $user= mysqli_fetch_assoc($user);
            
            $_SESSION['login'] = $user['email'];
        } 
    }

}
else{



}
    

?>
<h1>Inloggen</h1>

<form method="post">
    <input type="text" name="email" placeholder="email"><br>
    <input type="password" name="pass" placeholder="pass"><br>
    <button type="submit">Inloggen</button>
</form>