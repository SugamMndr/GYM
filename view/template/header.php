<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="<?= baseURL() ?>/favicon.ico">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'ALPHA GYM'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= baseURL(); ?>/assets/index.css">
    <style>
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .form-header {
            background-color: #6610f2;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }

        .form-body {
            padding: 30px;
        }
    </style>
</head>

<body>
    <?php if (isLoggedIn()): ?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid d-flex justify-content-center items-align-center">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-5">
                        <li class="nav-item fw-semibold">
                            <a class="nav-link" href="trainers">Trainers</a>
                        </li>
                        <li class="nav-item fw-semibold">
                            <a class="nav-link" href="members">Members</a>
                        </li>
                        <li>
                            <a class="navbar-brand fw-bold" href="<?= baseURL(); ?>">ALPHA GYM</a>
                        </li>
                        <li class="nav-item fw-semibold">
                            <a class="nav-link" href="membership">Membership</a>
                        </li>
                        <li class="nav-item fw-semibold">
                            <a class="nav-link" href="equipments">Equipment</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container d-flex justify-content-end">
            <a class="btn btn-primary" href="logout">Logout</a>
        </div>
    <?php endif; ?>