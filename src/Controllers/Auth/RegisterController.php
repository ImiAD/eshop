<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Base\Controller;
use App\Core\Config;
use App\Core\Contracts\Service;
use App\Core\Http\Request;
use App\Core\Validators\ValidatorFile;
use App\Core\Validators\ValidatorForm;
use App\Models\BaseModel;

class RegisterController extends Controller
{
    private Service $service;
    private ?BaseModel $result = null;

    public function __construct(Request $request, Config $config, Service $service)
    {
        parent::__construct($request, $config);
        $this->service = $service;
    }

    public function showRegisterForm(): string
    {
        return $this->view->render('auth/register');
    }

    public function register(): void
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
//                ->except(...['email', 'password']) // или передавать аргументы просто как строки, а не массив строк
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

            $this->result = $this->service->createCustomer($result);

            if (is_null($this->result)) {
                $_SESSION['errors'] = ['error' => $this->config->getError('error_save')];
                $this->redirect('/auth/login');
            }

            $this->saveUserInSession();

            $this->redirect('dashboard');
        }

        $this->redirect('/');
    }

    private function saveUserInSession(): void
    {
        $_SESSION['user'] = [
            'id' => $this->result->getId(),
            'first_name' => $this->result->getFirstName(),
            'last_name' => $this->result->getLastName(),
            'email' => $this->result->getEmail(),
            'is_ban' => $this->result->getIsBan(),
            'created_at' => $this->result->getCreatedAt(),
            'updated_at' => $this->result->getUpdatedAt(),
        ];
    }
}
