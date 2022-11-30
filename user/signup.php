<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <?php
    require 'header.php';
    ?>
</head>

<body>
    <div class="container mt-4">
        <form class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputemailsignup">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="phonenumber">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" id="repeatpassword">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Birth</label>
                <input type="date" class="form-control" id="inputCity">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Remember Password
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <a href="http://localhost/appbootcamp">Sign Up</a>
                </button>
            </div>
        </form>
    </div>

</body>

</html>