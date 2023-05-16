<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アカウント作成</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>
    <div class="container">
        <div class="login-head py-3">
            <span class="fs-2">アカウント作成</span>
        </div>
        <div class="login-main">
            <form class="needs-validation" action="handle/handleSignup.php" method="post">
                <div class="input-group was-validated mb-3">
                    <input class="form-control" name="email" type="email" id="email" placeholder="メール" required>
                </div>
                <div class="input-group was-validated mb-3">
                    <input class="form-control" name="password" type="password" placeholder="パスワード" required>
                </div>
                <div class="input-group was-validated mb-3">
                    <span class="input-group-text " id="">@</span>
                    <input class="form-control" name="username" type="text" placeholder="ID" required>
                </div>
                <div class="input-group was-validated mb-3">
                    <input class="form-control" name="name" type="text" placeholder="表示名" required>
                </div>
                <input class="btn btn-primary" type="submit" name="signup">
            </form>
        </div>
        <div class="login-food d-flex justify-content-end">
            <span ><a href="login.php" >ログイン画面へ</a></span>
            
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>