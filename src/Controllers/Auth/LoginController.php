<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Base\Controller;
use App\Core\Database\PDOBuilder;
use App\Core\Http\Request;
use App\Core\Validators\ValidatorForm;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;

class LoginController extends Controller
{
    private CustomerService $service;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new CustomerService(new CustomerRepository(PDOBuilder::getInstance()));
    }

    public function showLoginForm(): string
    {
        return $this->view->render('auth/login');
    }

    public function login()
    {
        if ($this->request->isPost()) {
            try {
               $validator = new ValidatorForm();
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            $result = $validator
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

            $result = $this->service->findByIdCustomer($result);

            if (is_null($result)) {
                // или тут лучше вызывать статику конфига?
                $_SESSION['errors'] = ['error' => $validator->getMessage()['error_login_or_password']];
                $this->redirect('/auth/login');
            }

            $_SESSION['user'] = [
                'id' => $result->getId(),
                'first_name' => $result->getFirstName(),
                'last_name' => $result->getLastName(),
                'email' => $result->getEmail(),
                'is_ban' => $result->getIsBan(),
                'created_at' => $result->getCreatedAt(),
                'updated_at' => $result->getUpdatedAt(),
            ];
            $this->redirect('dashboard');
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
