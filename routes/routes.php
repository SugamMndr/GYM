<?php
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = '/alpha-gym';
$path = str_replace($base, '', $request);

switch ($path) {
    case '/':
    //----------------------------------------------------------------------------------- front end
    case '/home':
        require ROOT . '/view/home.php';
        break;

    case '/trainers':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/trainer/show-trainer.php';
        break;

    case '/create-trainer':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/trainer/create-trainer.php';
        break;

    case '/members':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/members/show-member.php';
        break;

    case '/create-member':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/members/create-member.php';
        break;

    case '/membership':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/membership/show-membership.php';
        break;

    case '/create-membership':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/membership/create-membership.php';
        break;

    case '/equipments':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/equipment/show-equipment.php';
        break;

    case '/create-equipment':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/equipment/create-equipment.php';
        break;

    //----------------------------------------------------------------------------------- Auth
    case '/page-not-found':
        require ROOT . '/404.php';
        break;

    case '/login':
        require ROOT . '/view/auth/login.php';
        break;

    case '/register':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/auth/register.php';
        break;

    case '/add-user':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/validation/register-validation.php';
        break;

    case '/login-validate':
        require ROOT . '/validation/login-validation.php';
        break;

    case '/logout':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/validation/logout.php';
        break;
    //----------------------------------------------------------------------------------- database
    case '/migrate-fresh':
        require ROOT . '/database/migration-fresh.php';
        break;

    case '/add-trainer':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/store/add-trainer.php';
        break;

    case '/add-member':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/store/add-member.php';
        break;

    case '/edit-trainer':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/trainer/edit-trainer.php';
        break;

    case '/edit-member':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/members/edit-member.php';
        break;

    case '/add-membership':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/store/add-membership.php';
        break;

    case '/edit-membership':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/membership/edit-membership.php';
        break;

    case '/add-equipment':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/store/add-equipment.php';
        break;

    case '/edit-equipment':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/view/equipment/edit-equipment.php';
        break;


    case '/delete-trainer':
        if (!isLoggedIn()) {
            header('Location: page-not-found');
            exit;
        }
        require ROOT . '/validation/delete-trainer.php';
        break;

    default:
        http_response_code(404);
        require ROOT . '/404.php';
        break;
}
