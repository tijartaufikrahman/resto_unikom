<div class="container-fluid p-5">
    <div class="row ">
        <div class="col-6 offset-md-2 col-md-8 ">
            <div class="row shadow">
                <div class="col-6 rounded-3" style="background-color:#357CA5;">
                    <div class=" " style="height: 500px;">
                        <div class="">
                            <h2 class="text-shadow text-center text-white mt-5 fw-normal">Hello, Welcome!</h2>
                            <p class="fw-semibold mt-4 text-light text-center">Welcome back, team! Let's make today a success together!</p>

                        </div>
                        <div class="" style="margin-top: -20px;">
                            <img src="./../../../public/img/logo_login.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>











                <div class="col-6 bg-white">
                    <div class="p-4 ">
                        <div class="row">
                            <div class=" col-md-12 ">
                                <?php if (isset($_SESSION['success'])) : ?>
                                    <div class=" alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo $_SESSION['success']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <?php unset($_SESSION['success']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['loginError'])) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $_SESSION['loginError']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['loginError']); ?>
                                <?php endif; ?>
                                <h1 class="h3 mb-3 fw-normal text-body-secondary text-center" style="margin-top: 70px;">Please Login</h1>
                                <main class="form-signin w-100 m-auto ">


                                    <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="margin-top: 60px;">
                                        <!-- <input type="hidden" name="_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>"> CSRF token -->

                                        <div class="form-floating mb-2">
                                            <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" placeholder="name@example.com" autofocus required value="<?php echo isset($old['email']) ? htmlspecialchars($old['email']) : ''; ?>">
                                            <label for="email">Email address</label>
                                            <?php if (isset($errors['email'])) : ?>
                                                <div class="invalid-feedback">
                                                    <?php echo $errors['email']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-floating mb-2">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                            <label for="password">Password</label>
                                        </div>

                                        <button class="btn  text-white w-100 py-2" type="submit" style="background-color: #357CA5;">Login</button>
                                    </form>

                                    <!-- <small class="d-block text-center my-3">Not Registered? <a href="/register">Register Now!</a></small> -->
                                </main>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>