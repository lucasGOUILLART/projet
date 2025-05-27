<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header> 
        <a class="bouton" href="index.php">Back</a>
        <h1>RUSH <br> HOUR</h1>
    </header>
    <div class="container">
        <form class="form1" action="update_account.php" method="post" class="account-form">
            <h2>My Account</h2>
            <p>Welcome, <?= htmlspecialchars($_SESSION['pseudo'] ?? 'Guest') ?>!</p><br>
            <input type="email" id="email" name="email" placeholder="Email address" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" required>
            <br><br>
            <input type="text" id="pseudo" name="pseudo" placeholder="Username" value="<?= htmlspecialchars($_SESSION['pseudo'] ?? '') ?>" required>
            <br><br>
            <input type="date" id="birthdate" placeholder="Date of birth" name="birthdate" value="<?= htmlspecialchars($_SESSION['birthdate'] ?? '') ?>" required>
            <br><br>
            <input type="password" id="password" name="password" placeholder="New password">
            <br><br>
            <button class="bouton2" type="submit">Update</button><br>
            <button class="bouton2" type="submit" name="logout">Log out</button>
        </form>
        <br>
        <?php if (isset($_GET['success'])): ?>
            <div class="success">Information updated successfully!</div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="errors"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
</body>
</html>
