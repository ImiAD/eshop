<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Base\Controller;
use App\Core\Database\PDOBuilder;
use App\Core\Http\Request;
use App\Core\Validators\ValidatorFile;
use App\Core\Validators\ValidatorForm;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;

class RegisterController extends Controller
{
    private CustomerService $service;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->service = new CustomerService(new CustomerRepository(PDOBuilder::getInstance()));
    }

    public function showRegisterForm(): string
    {
        return $this->view->render('auth/register');
    }

    public function register()
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

            $errors = $validator->getErrors();

            if (!empty($this->request->hasFile('file'))) {
                try {
                    $validator = new ValidatorFile();
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }

            $errorsData = array_merge($errors, []);

            if (!empty($errorsData)) {
                $_SESSION['errors'] = $errorsData;
                $this->redirect('auth/register');
            }

            $result = $this->service->createCustomer($result);

            if (is_null($result)) {
                $_SESSION['errors'] = ['error' => $validator->getMessage()['error_save']];
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
}
