<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', 1000000);
        array_push($messages, 'Спасибо, результаты сохранены');
    }

    $values = array(
        'name' => empty($_COOKIE['form_name']) ? '' : $_COOKIE['form_name'],
        'email' => empty($_COOKIE['form_email']) ? '' : $_COOKIE['form_email'],
        'gender' => empty($_COOKIE['form_gender']) ? '' : $_COOKIE['form_gender'],
        'parts' => empty($_COOKIE['form_parts']) ? '' : $_COOKIE['form_parts'],
        'power' => empty($_COOKIE['form_power']) ? '' : $_COOKIE['form_power'],
        'age' => empty($_COOKIE['form_age']) ? '' : $_COOKIE['form_age'],
        'bio' => empty($_COOKIE['form_bio']) ? '' : $_COOKIE['form_bio']
    );

    setcookie('form_name', '', 1);
    setcookie('form_email', '', 1);
    setcookie('form_bio', '', 1);
    setcookie('form_parts', '', 1);
    setcookie('form_power', '', 1);
    setcookie('form_age', '', 1);
    setcookie('form_gender', '', 1);

    $errors = array(
        'name' => empty($_COOKIE['error_name']) ? '' : $_COOKIE['error_name'],
        'email' => empty($_COOKIE['error_email']) ? '' : $_COOKIE['error_email'],
        'gender' => empty($_COOKIE['error_gender']) ? '' : $_COOKIE['error_gender'],
        'parts' => empty($_COOKIE['error_parts']) ? '' : $_COOKIE['error_parts'],
        'power' => empty($_COOKIE['error_power']) ? '' : $_COOKIE['error_power'],
        'age' => empty($_COOKIE['error_age']) ? '' : $_COOKIE['error_age'],
        'bio' => empty($_COOKIE['error_bio']) ? '' : $_COOKIE['error_bio'],
        'contract' => empty($_COOKIE['error_contract']) ? '' : $_COOKIE['error_contract']
    );

    setcookie('error_name', '', 1);
    setcookie('error_email', '', 1);
    setcookie('error_gender', '', 1);
    setcookie('error_power', '', 1);
    setcookie('error_parts', '', 1);
    setcookie('error_age', '', 1);
    setcookie('error_bio', '', 1);
    setcookie('error_contract', '', 1);

    include(__DIR__ . '/form.php');
} else {
    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('error_name', 'Введите свое имя', time() + 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('form_name', $_POST['name'], time() + 60 * 60);
    }

    if (empty($_POST['email'])) {
        setcookie('error_email', 'Введите свой адрес электронной почты', time() + 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('form_email', $_POST['email'], time() + 60 * 60);
    }

    if (empty($_POST['gender'])) {
        setcookie('error_gender', 'Укажите Ваш пол', time() + 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('form_gender', $_POST['gender'], time() + 60 * 60);
    }

    if (empty($_POST['parts'])) {
        setcookie('error_parts', 'Укажите количество конечностей', time() + 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('form_parts', $_POST['parts'], time() + 60 * 60);
    }

    if (empty($_POST['power'] == 0)) {
        setcookie('error_power', 'Укажите Вашу способность', time() + 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('form_power', $_POST['power'], time() + 60 * 60);
    }

    if ($_POST['age'] == 0) {
        setcookie('error_age', 'Укажите Ваш возраст', time() + 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('form_age', $_POST['age'], time() + 60 * 60);
    }

    if (empty($_POST['bio'])) {
        setcookie('error_bio', 'Введите свою биографию', time() + 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('form_bio', $_POST['bio'], time() + 60 * 60);
    }

    if (!isset($_POST['contract'])) {
        setcookie('error_contract', 'Ознакомьтесь с контрактом', time() + 60 * 60);
        $errors = TRUE;
    }

    if (!$errors) {
        $xml = new SimpleXMLElement('<document/>');
        $child = $xml->AddChild('name', $_POST['name']);
        $child = $xml->AddChild('email', $_POST['email']);
        $child = $xml->AddChild('age', $_POST['age']);
        $child = $xml->AddChild('gender', $_POST['gender']);
    
/*
        if (!empty($_POST['power'])) {
            $sp = $xml->AddChild('power');
            foreach ($_POST['power'] as $power) {
                $sp->AddChild($power, 'yes');
            }
        }

       */ 
        $child = $xml->AddChild('Quantity', $_POST['parts']);
        $child = $xml->AddChild('bio', $_POST['bio']);

        //сохранение в xml файл в папке list
        $files_dir = $_SERVER['DOCUMENT_ROOT'] . '/list/';
        $file = $files_dir . uniqid() . '.xml';
        $content = $xml->AsXML();

        setcookie('save', '1');

        file_put_contents($file, $content);
    }

    header('Location: index.php');

}
