<?php
require_once 'db.php';
require_once 'student.php';

$db = new Database();
$conn = $db->connect();
$student = new Student($conn);

if(isset($_POST['submit'])) {
    $data = [
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'course' => $_POST['course']
    ];

    if($student->create($data)) {
        echo "Студент добавлен успешно!";
    } else {
        echo "Ошибка при добавлении студента.";
    }
}

if(isset($_GET['id'])) {
    $studentData = $student->readOne($_GET['id']);
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'course' => $_POST['course']
    ];

    if($student->update($id, $data)) {
        echo "Студент обновлен успешно!";
    } else {
        echo "Ошибка при обновлении студента.";
    }
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if($student->delete($id)) {
        echo "Студент удален успешно!";
    } else {
        echo "Ошибка при удалении студента.";
    }
}

$students = $student->readAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Журнал Студентов</title>
</head>
<body>
    <h1>Добавить нового студента</h1>
    <form action="" method="post">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="surname">Фамилия:</label><br>
        <input type="text" id="surname" name="surname" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Телефон:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <label for="course">Курс:</label><br>
        <input type="number" id="course" name="course" required><br>
        <input type="submit" name="submit" value="Добавить">
    </form>

    <h1>Список студентов</h1>
    <table border="1">
        <tr>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Курс</th>
            <th>Действия</th>
        </tr>
        <?php foreach($students as $studentItem): ?>
        <tr>
            <td><?php echo $studentItem['name']; ?></td>
            <td><?php echo $studentItem['surname']; ?></td>
            <td><?php echo $studentItem['email']; ?></td>
            <td><?php echo $studentItem['phone']; ?></td>
            <td><?php echo $studentItem['course']; ?></td>
            <td>
                <a href="?id=<?php echo $studentItem['id']; ?>">Редактировать</a>
                <a href="?delete=<?php echo $studentItem['id']; ?>">Удалить</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if(isset($_GET['id'])): ?>
    <h1>Редактировать студента</h1>
    <form action="" method="post">
        <label for="name">Имя:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $studentData['name']; ?>" required><br>
        <label for="surname">Фамилия:</label><br>
        <input type="text" id="surname" name="surname" value="<?php echo $studentData['surname']; ?>" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $studentData['email']; ?>" required><br>
        <label for="phone">Телефон:</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo $studentData['phone']; ?>"><br>
        <label for="course">Курс:</label><br>
        <input type="number" id="course" name="course" value="<?php echo $studentData['course']; ?>" required><br>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" name="update" value="Обновить">
    </form>
    <?php endif; ?>
</body>
</html>

