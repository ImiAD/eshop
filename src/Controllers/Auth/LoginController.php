<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Base\Controller;
use App\Core\Config;
use App\Core\Database\PDOBuilder;
use App\Core\Http\Request;
use App\Core\Validators\ValidatorForm;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;

class LoginController extends Controller
{
    private CustomerService $service;

    public function __construct(Request $request, Config $config)
    {
        parent::__construct($request, $config);
        $this->service = new CustomerService(new CustomerRepository(PDOBuilder::getInstance()));
    }

    public function showLoginForm(): string
    {
        return $this->view->render('auth/login');
    }

    public function login(): void
    {
        if ($this->request->isPost()) {
            try {
               $validator = new ValidatorForm();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            $credentials = $validator
                ->load($this->request->post())
                ->clear()
                ->isEmpty()
                ->isValidEmail()
                ->toArray();

            $errorsData = $validator->getErrors();

            if (!empty($errorsData)) {
                $_SESSION['errors'] = $errorsData;
                $this->redirect('/auth/login');
            }

            $user = $this->service->findByIdCustomer($credentials);

            if (is_null($user)) {
                $user = $this->service->findByIdManager($credentials);
            }

            if (is_null($user)) {
                $_SESSION['errors'] = ['error' => $this->config->getError('error_login_or_password')];
                $this->redirect('/auth/login');
            }

            $_SESSION['user'] = [
                'id' => $user->getId(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'is_ban' => $user->getIsBan(),
                'created_at' => $user->getCreatedAt(),
                'updated_at' => $user->getUpdatedAt(),
            ];
            $this->redirect('/dashboard');
        }

        $this->redirect('/');
    }

    public function logout(): void
    {
        if ((int)$_GET['exit'] === 1) {
            $_SESSION['user'] = null;
            unset($_SESSION['user']);

            $this->redirect('/');
        }
    }
}
