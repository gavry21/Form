<!doctype html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link rel="stylesheet"
          href="../static/form/style.css?ver=<?php echo filemtime(dirname(__DIR__) . "/static/auth/style.css") . '111'; ?>">
    <title>Заполните форму</title>
</head>


<body class="back">

<div class="center">
    <?php foreach ($messages as $message): ?>
        <div class="message"><?php echo $message ?></div>
    <?php endforeach; ?>

    <form action="/" method="POST" accept-charset="UTF-8">
        <label> Имя:&nbsp;
            <?php if ($errors['name']): ?>
                <span class="error"><?php echo $errors['name'] ?></span>
            <?php endif ?>
            <br/>
            <input type="text"
                   class="<?php if ($errors['name']): ?>error<?php endif ?>"
                   name="name"
                   value="<?php echo $values['name'] ?>"/>
        </label><br/><br/>

        <label> Email:&nbsp;
            <?php if ($errors['email']): ?>
                <span class="error"><?php echo $errors['email'] ?></span>
            <?php endif ?>
            <br/>
            <input type="text"
                   class="<?php if ($errors['email']): ?>error<?php endif ?>"
                   name="email"
                   value="<?php echo $values['email'] ?>"/>
        </label><br/><br/>

        <label> Дата рождения:
            <br/>
            <?php if ($errors['age']): ?>
                <span class="error"><?php echo $errors['age'] ?></span>
            <?php endif ?>
            <select name="age">
                <option value="0">Не выбрано</option>
                <?php for ($i = 1990; $i < 2019; $i++): ?>
                      <option <?php if ($values['age'] == $i): ?>selected<?php endif?>
                            value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor ?>
            </select>
        </label><br/><br/>

        <label>Пол:
            <br/>
            <?php if ($errors['gender']): ?>
                <span class="error"><?php echo $errors['gender'] ?></span>
            <?php endif ?>
            <input type="radio" name="gender" value="male"> Мужской
            <input type="radio" name="gender" value="female"> Женский
        </label><br/><br/>

        <label> Количество конечностей:
            <br/>
            <?php if ($errors['parts']): ?>
                <span class="error"><?php echo $errors['parts'] ?></span>
            <?php endif ?>
            <input type="radio" name="parts" value="1"> 1
            <input type="radio" name="parts" value="2"> 2
            <input type="radio" name="parts" value="3"> 3
            <input type="radio" name="parts" value="4"> 4
        </label><br/><br/>

        <label> Сверхспособности:
            <br/>
            <select name="power"
                    multiple="multiple" <?php if ($errors['power']) {print 'class="error"';} ?>>
                <option value="S1">Бессмертие</option>
                <option value="S2">Прохождение сквозь стены</option>
                <option value="S3">Левитация</option>
            </select>
        </label><br/><br/>

        <label> Биография:&nbsp;
            <?php if ($errors['bio']): ?>
                <span class="error"><?php echo $errors['bio'] ?></span>
            <?php endif ?>
            <br/>
            <textarea name="bio"
                      class="<?php if ($errors['bio']): ?>error<?php endif ?>"><?php echo $values['bio'] ?></textarea>
        </label><br/><br/>

        <label class="<?php if ($errors['contract']): ?>error<?php endif ?>">
            <input type="checkbox" name="contract" value='1'>С контрактом ознакомлен
        </label>
        <?php if ($errors['contract']): ?>
            <span class="error"><?php echo $errors['contract'] ?></span>
        <?php endif ?>
        <br/>

        <input type="submit" value="Отправить"/>
    </form>
</div>

</body>

</html>