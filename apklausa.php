<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['answer'])){
        $_SESSION['msg'] =  'Jūs nieko nepasirinkote.';
        $_SESSION['status'] = 0;
    } elseif ($_SESSION['correct'] != $_POST['answer']){
        $_SESSION['msg'] =  '<p style="color: red;">Jūsų atsakymas neteisingas.</p>';
        $_SESSION['status'] = 0;
    } else {
        $_SESSION['msg'] =  '<p style="color: green;">Jūsų atsakymas teisingas.</p>';
        $_SESSION['status'] = 1;
    }
    header('Location: http://brik.lt/apklausa.php');
    die;
}
//naujas arba atsakyta teisingai
if(!isset($_SESSION['status']) || 1 == $_SESSION['status']) {

    $info = json_decode(file_get_contents('duomenys.json'),1);
    shuffle($info);
    $_SESSION['correct'] = $info[0]['correct'];
    $_SESSION['img'] = $info[0]['img'];
    unset($_SESSION['status']);
}
// Atsakymas neteisingas - kartojam
else {
    $info[0]['img'] = $_SESSION['img'];
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apklausa</title>
</head>
<style>
.block {
    margin-top: 40px;
    display: inline-block;
    width: 550px;
    margin-left: calc(50% - 275px);
    padding: 40px 40px 80px;
    border: 1px solid #9bc5f9;
    border-radius: 10px;
}
img {
    display: inline-block;
    float: left;
    width: 300px;
    height: 300px;
}
.right {
    display: inline-block;
    float: left;
    width: 200px;
    height: 200px;
    margin-left: 30px;
}
input {
    display: block;
    float: left;
    margin-right: 10px;
    margin-top: 4px;
}
.title {
    font-size: 25px;
    margin-bottom: 30px;
}
button {
    display: block;
    width: 60%;
    margin-top: 40px;
    font-size: 16px;
    float: left;
    padding: 5px 20px;
    border-radius: 5px;
    border: 3px solid #9bc5f9;
    background-color: transparent;
}
.session {
    display: inline-block;
    width: 100%;
}
.check {
    margin-bottom: 20px;
}
label {
    font-size: 20px;
}
</style>
<body>
<div class="block">
    <h1>Apklausa</h1>
        <div>
            <img src="<?= $info[0]['img']?>" alt="foto">
        </div>
        <div class="right">
            <form action="" method="post">
                <div class="title">Koks tai gyvūnas?</div>
                <div class="check">
                    <input type="radio" name="answer" value="1">
                    <label for="">Elnias</label>
                </div>
                <div class="check">
                    <input type="radio" name="answer" value="2">
                    <label for="">Šuo</label>
                </div>
                <div class="check">
                    <input type="radio" name="answer" value="3">
                    <label for="">Katinas</label>
                </div>
                <div class="check">
                    <input type="radio" name="answer" value="4">
                    <label for="">Begemotas</label>
                </div>
                <button type="submit" name="submit">Spėti</button>
            </form>
        </div>
        <?php if(isset($_SESSION['msg'])) { ?>
                <h2 class="session"> <?= $_SESSION['msg'] ?></h2>
                <?php unset($_SESSION['msg']) ?>
                <?php } ?>
</div>
</body>
</html>
