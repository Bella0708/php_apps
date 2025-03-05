<?php
require_once 'db.php';
require_once 'workout.php';

$db = new Database();
$conn = $db->connect();
$workout = new Workout($conn);

if(isset($_POST['submit'])) {
    $data = [
        'date' => $_POST['date'],
        'exercise' => $_POST['exercise'],
        'sets' => $_POST['sets'],
        'reps' => $_POST['reps'],
        'weight' => $_POST['weight']
    ];

    if($workout->create($data)) {
        echo "Запись добавлена успешно!";
    } else {
        echo "Ошибка при добавлении записи.";
    }
}

if(isset($_GET['id'])) {
    $workoutData = $workout->readOne($_GET['id']);
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $data = [
        'date' => $_POST['date'],
        'exercise' => $_POST['exercise'],
        'sets' => $_POST['sets'],
        'reps' => $_POST['reps'],
        'weight' => $_POST['weight']
    ];

    if($workout->update($id, $data)) {
        echo "Запись обновлена успешно!";
    } else {
        echo "Ошибка при обновлении записи.";
    }
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if($workout->delete($id)) {
        echo "Запись удалена успешно!";
    } else {
        echo "Ошибка при удалении записи.";
    }
}

$workouts = $workout->readAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дневник Тренировок</title>
</head>
<body>
    <h1>Добавить новую запись</h1>
    <form action="" method="post">
        <label for="date">Дата:</label><br>
        <input type="date" id="date" name="date" required><br>
        <label for="exercise">Упражнение:</label><br>
        <input type="text" id="exercise" name="exercise" required><br>
        <label for="sets">Подходы:</label><br>
        <input type="number" id="sets" name="sets" required><br>
        <label for="reps">Повторения:</label><br>
        <input type="number" id="reps" name="reps" required><br>
        <label for="weight">Вес:</label><br>
        <input type="number" step="0.01" id="weight" name="weight" required><br>
        <input type="submit" name="submit" value="Добавить">
    </form>

    <h1>Список тренировок</h1>
    <table border="1">
        <tr>
            <th>Дата</th>
            <th>Упражнение</th>
            <th>Подходы</th>
            <th>Повторения</th>
            <th>Вес</th>
            <th>Действия</th>
        </tr>
        <?php foreach($workouts as $workoutItem): ?>
        <tr>
            <td><?php echo $workoutItem['date']; ?></td>
            <td><?php echo $workoutItem['exercise']; ?></td>
            <td><?php echo $workoutItem['sets']; ?></td>
            <td><?php echo $workoutItem['reps']; ?></td>
            <td><?php echo $workoutItem['weight']; ?></td>
            <td>
                <a href="?id=<?php echo $workoutItem['id']; ?>">Редактировать</a>
                <a href="?delete=<?php echo $workoutItem['id']; ?>">Удалить</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if(isset($_GET['id'])): ?>
    <h1>Редактировать запись</h1>
    <form action="" method="post">
        <label for="date">Дата:</label><br>
        <input type="date" id="date" name="date" value="<?php echo $workoutData['date']; ?>" required><br>
        <label for="exercise">Упражнение:</label><br>
        <input type="text" id="exercise" name="exercise" value="<?php echo $workoutData['exercise']; ?>" required><br>
        <label for="sets">Подходы:</label><br>
        <input type="number" id="sets" name="sets" value="<?php echo $workoutData['sets']; ?>" required><br>
        <label for="reps">Повторения:</label><br>
        <input type="number" id="reps" name="reps" value="<?php echo $workoutData['reps']; ?>" required><br>
        <label for="weight">Вес:</label><br>
        <input type="number" step="0.01" id="weight" name="weight" value="<?php echo $workoutData['weight']; ?>" required><br>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" name="update" value="Обновить">
    </form>
    <?php endif; ?>
</body>
</html>

