<html>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <head></head>
    <body>
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="box-register ">
                <form action="<?= base_url('/auth/register') ?>" method="POST">
                    <!-- <?= csrf_field(); ?> -->
                    <div class="header-register">
                        <h2>Register</h2>
                    </div>

                        <div class="container-form">
                            <!-- Form Error -->
                            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <h5>Periksa Entrian Form</h5>
                                    <?php echo session()->getFlashdata('error'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <!-- End Form Error -->
                            <!-- {{-- Form Email --}} -->
                            <div class="form-group" style="margin-bottom:25px;">
                                <input type="text" class="form-control form-input-text" placeholder="Email" name="email">
                            </div>
                            <!-- {{-- EndForm Password --}} -->

                            <!-- {{-- Form Password --}} -->
                            <div class="form-group" style="margin-bottom:25px;">
                                <input type="password" class="form-control form-input-text" name="password" placeholder="Password">
                            </div>
                            <!-- {{-- End Form Password --}} -->

                             <!-- {{-- Form Name --}} -->
                             <div class="form-group" style="margin-bottom:25px;">
                                <input type="text" class="form-control form-input-text" name="name" placeholder="Name">
                            </div>
                            <!-- {{-- End Form Name --}} -->
                            <button type="submit" class="btn btn-primary w-100" style="height: 50px; margin-bottom:15px;">Register</button>
                            <p>You have a member? <a href="<?= base_url('auth/login') ?>">Login Now!</a></p>
                        </div>

                </form>
            </div>
        </div>
    </body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>


<style>
    .box-register {
        width: 500px;
        min-height: 400px;
        border: 1px solid;
        padding: 10px;
        box-shadow: 5px 10px 8px #888888;
    }
    .container-form {
        padding: 0 20px;
    }
    .header-register {
        text-align: center;
        padding: 30px 10px
    }
    .form-input-text {
        height: 50px; 
        border: 1px solid
    }
</style>