<form enctype="multipart/form-data" action="/index.php?action=newmessage" method="POST">
    <input type="text" name="username" /><br>
    <textarea name="message">Сообщение...</textarea><br>
    <input type="hidden" name="csrf-token" value='6154ae4355669'/>
    <input type="file" name="picture" />
    <input type="submit" value ="Отправить">
</form>

<form action="/index.php?filter=username" method="GET">
    <input type="text" name="filter_username" /><br>
    <input type="hidden" name="csrf-token" value='6154ae4355669'/>
    <input type="submit" value ="Показать все записи">
</form>

<?php
    include 'db.php';
    set_time_limit(0);
    if($_GET['action'] === 'newmessage')
    {
        $token = '6154ae4355669';
        if(empty($_POST['csrf-token']) || $_POST['csrf-token'] !== $token)
        {
            echo 'Ты не пройдешь, грязный хакер!';
            exit();
        }
        $regex = '/^([a-zA-Z0-9]+)$/';
        if(!empty($_POST['username']) && !empty($_POST['message'])) {
            if(!preg_match($regex,$_POST['username']))
            {
                echo "Ваше имя не соответствует формату!<br>";
            } else {
                $message = [
                    'username' => $_POST['username'],
                    'message' => htmlspecialchars($_POST['message']),
                    'date' => date('d-m-Y')
                ];

                if(!empty($_FILES['picture']))
                {
                    $file_name = $_FILES['picture']['name'];
                    $file_path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$file_name;
                    move_uploaded_file($_FILES['picture']['tmp_name'],$file_path);
                    $message['picture'] = $file_name;
                }
                addMessage($message['username'], $message['message'], $message['picture']);
            }

        }
    }

    if(!empty($_GET['filter']) && $_GET['filter'] == 'username')
    {
        $messages = getMessagesByUserName($_GET['filter_username']);
    } else {
        $messages = getMessages();
    }

    foreach($messages as $message)
    {
        echo "<b>{$message['date']}</b> <strong><a href='/index.php?filter=username&filter_username={$message['username']}'>{$message['username']}</a></strong> <i>{$message['message']}</i><br>";
        if(!empty($message['picture']))
        {
            echo "<img src=/images/{$message['picture']} width='15%'>";
        }
    }
?>
