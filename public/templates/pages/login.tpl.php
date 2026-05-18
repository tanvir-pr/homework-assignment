<div class="row g-4">
    <div class="col-md-6">
        <h2>Login</h2>
        <form action="login2" method="post">
            <div class="mb-3">
                <label class="form-label">Login name</label>
                <input class="form-control" name="login_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button class="btn btn-success">Login</button>
        </form>
    </div>
    <div class="col-md-6">
        <h2>Register</h2>
        <form action="register" method="post">
            <div class="mb-3">
                <label class="form-label">Family name</label>
                <input class="form-control" name="family_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Surname</label>
                <input class="form-control" name="surname" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Login name</label>
                <input class="form-control" name="login_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
