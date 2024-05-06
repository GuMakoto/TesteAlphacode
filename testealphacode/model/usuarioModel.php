<?php 

    class UsuarioModel {

        private $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function buscarDados() {
    
            try {
                $sql = "SELECT * FROM usuario";
    
                $result = $this->pdo->prepare($sql);
        
                $result->execute();
    
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } catch (\Throwable $th) {
                echo 'erro ao buscar os dados:' . $th->getMessage();
            }
    
        }

        public function salvarDados($name, $email, $date, $job, $telephone, $cellphone, $whatsapp, $notificationEmail, $sms) {

            try {
                $sql = "INSERT INTO usuario (nome, email, dataNascimento, profissao, telefone, celular, whatsapp, notificacaoEmail, sms) VALUES ('$name', '$email', '$date', '$job', '$telephone', '$cellphone', '$whatsapp', '$notificationEmail', '$sms')";

                $result = $this->pdo->prepare($sql);
        
                $result->execute();
            } catch (\Throwable $th) {
                echo 'erro ao salvar o usuário:' . $th->getMessage();
            }
        }

        public function deletarUsuarios($id) {

            try {
                $sql = "DELETE FROM usuario WHERE id = $id";

                $result = $this->pdo->prepare($sql);
    
                $result->execute();
    
            } catch (\Throwable $th) {
                echo 'erro ao excluir usuário:' . $th->getMessage();
            }
        }

        public function editarUsuario($name, $email, $date, $job, $telephone, $cellphone, $whatsapp, $notificationEmail, $sms) {

            try {
                $sql = "UPDATE usuario SET nome = '$name', email = '$email', dataNascimento = '$date', profissao = '$job', telefone = '$telephone', celular = '$cellphone', whatsapp = '$whatsapp', notificationEmail = '$notificationEmail', sms = '$sms'";
            } catch (\Throwable $th) {
                echo 'erro ao atualizar usuario' . $th->getMessage();
            }
        }

    }


?>