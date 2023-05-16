<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>
    <div class="container">
        <div class="login-head py-3">
            <span class="fs-2">ログイン</span>
        </div>
        <div class="login-main">
            <form class="needs-validation" action="handle/handleLogin.php" method="post">
                <div class="input-group was-validated mb-3">
                    <input class="form-control" name="email" type="email" id="email" placeholder="メール" required>
                </div>
                <div class="input-group was-validated mb-3">
                    <input class="form-control" name="password" type="password" placeholder="パスワード" required>
                </div>
                <input class="btn btn-primary" type="submit" name="login">
            </form>
        </div>
        <div class="login-food d-flex justify-content-end">
            <span><a href="signup.php">アカウント作成へ</a></span>
            
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>