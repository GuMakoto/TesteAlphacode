<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    require_once '../model/usuarioModel.php';

    class UsuarioController {

        private $userModel;

        public function __construct()
        {
            $this->userModel = new UsuarioModel(new PDO('mysql:host=localhost;dbname=alphacode', 'root', ''));
        }

        public function buscarDados() {
        
            $dados = $this->userModel->buscarDados();
            header('Content-Type: application/json');
            return $dados;
        }

        public function recebeDados() {
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    
                $name = $_POST['name'];
                $email = $_POST['email'];
                $date = $_POST['date'];
                $job = $_POST['job'];
                $telephone = $_POST['telephone'];
                $cellphone = $_POST['cellphone'];
                $whatsapp = isset($_POST['whatsapp']) == '' ? false : true;
                $notificationEmail = isset($_POST['notificationEmail'])  == '' ? false : true;
                $sms = isset($_POST['sms'])  == '' ? false : true;

                $this->userModel->salvarDados($name, $email, $date, $job, $telephone, $cellphone, $whatsapp, $notificationEmail, $sms); 
                
            }
        
        }

        public function deletarUsuario() {
            $data = json_decode(file_get_contents("php://input"), true);
            $id = $data['id'];
            $this->userModel->deletarUsuarios($id);

            return 'Deletado com sucesso';
        }

        public function editarDados() {
            
    
            $name = $_POST['name'];
            $email = $_POST['email'];
            $date = $_POST['date'];
            $job = $_POST['job'];
            $telephone = $_POST['telephone'];
            $cellphone = $_POST['cellphone'];
            $whatsapp = isset($_POST['whatsapp']) == '' ? false : true;
            $notificationEmail = isset($_POST['notificationEmail'])  == '' ? false : true;
            $sms = isset($_POST['sms'])  == '' ? false : true;

            $this->userModel->editarUsuario($name, $email, $date, $job, $telephone, $cellphone, $whatsapp, $notificationEmail, $sms); 
        
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $userController = new UsuarioController();
        echo json_encode($userController->buscarDados());
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userController = new UsuarioController();
        $userController->recebeDados();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $userController = new UsuarioController();
        echo json_encode($userController->deletarUsuario());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'UPDATE') {
        $userController = new UsuarioController();
        echo json_encode($userController->editarDados());
    }
?>