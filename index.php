<?php
session_start();


$message = $_SESSION['message'] ?? "";
$status = $_SESSION['status'] ?? "";
$current_view = $_SESSION['current_view'] ?? "login";

unset($_SESSION['message']);
unset($_SESSION['status']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification Sécurisée</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="static/style.css">
    <style>
        .hidden { display: none !important; }
    </style>
</head>
<body>

<div class="main-container">
    <div class="login-card">
        
        <div class="card-header">
        <img src="static/logo.png" alt="Université Paris 8" class="logo">
        
        
    </div>
        
        <form id="login-form" method="POST" action="traitement.php" class="<?php echo ($current_view === 'register') ? 'hidden' : ''; ?>">
            <div class="input-group">
                <label>Identifiant</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="username" placeholder="Votre identifiant" required>
                </div>
            </div>
            <div class="input-group">
                <label>Mot de passe</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" placeholder="Votre mot de passe" required>
                </div>
            </div>
            <div class="actions">
                <button type="submit" name="action" value="login" class="btn-primary btn-full">Connexion</button>
                <div class="secondary-actions">
                    <button type="button" class="btn-link" onclick="window.location.href='index.php'">Reset</button>
                    <span class="separator">·</span>
                    <button type="button" class="btn-link btn-create" onclick="toggleView('register')">Inscription</button>
                </div>
            </div>
        </form>

        <form id="register-form" method="POST" action="traitement.php" class="<?php echo ($current_view === 'login') ? 'hidden' : ''; ?>">
            <div class="input-group">
                <label>Nouvel Identifiant</label>
                <div class="input-wrapper">
                    <i class="fas fa-user-plus input-icon"></i>
                    <input type="text" name="username" placeholder="Choisissez un pseudo" required>
                </div>
            </div>
            <div class="input-group">
                <label>Nouveau Mot de passe</label>
                <div class="input-wrapper">
                    <i class="fas fa-key input-icon"></i>
                    <input type="password" name="password" placeholder="Créez un mot de passe" required>
                </div>
            </div>
            <div class="actions">
                <button type="submit" name="action" value="register" class="btn-primary btn-full" style="background-color: #00b894;">Créer</button>
                <div class="secondary-actions">
                    <button type="button" class="btn-link" onclick="toggleView('login')">Annuler</button>
                </div>
            </div>
        </form>

        <?php if (!empty($message)): ?>
            <div class="message-box <?php echo $status; ?>">
                <?php if ($status == 'error'): ?><i class="fas fa-exclamation-circle"></i><?php endif; ?>
                <?php if ($status == 'success'): ?><i class="fas fa-check-circle"></i><?php endif; ?>
                <span><?php echo $message; ?></span>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    function toggleView(view) {
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const title = document.getElementById('form-title');
        const subtitle = document.getElementById('form-subtitle');
        
        const messageBox = document.querySelector('.message-box');
        if (messageBox) messageBox.style.display = 'none';

        if (view === 'register') {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            title.innerText = 'Créer un compte';
            subtitle.innerText = 'Rejoignez-nous dès maintenant.';
        } else {
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
            title.innerText = 'Connexion';
            subtitle.innerText = 'Accédez à votre espace sécurisé.';
        }
    }
</script>

<div class="wave-container">
    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
</div>

</body>
</html>