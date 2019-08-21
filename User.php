<?php


class User
{
    private $endereco, $login, $senha, $database;
    public $id, $email, $nome, $senhaUser;
    public $exiteUser = 0;
    public $users = array();

    public function __construct($endereco, $login, $senha, $database)
    {
        $this->endereco = $endereco;
        $this->login = $login;
        $this->senha = $senha;
        $this->database = $database;
    }

    public function createUser($email, $nome, $senhaUser){
        $conecta = new mysqli($this->endereco, $this->login, $this->senha, $this->database);

        $insere = $conecta->prepare("INSERT INTO usuario (nome,email,senha) VALUES (?,?,?)");
        $insere->bind_param('sss', $nome,$email,$senhaUser );
        $insere->execute();
        $insere->close();
    }

    public function getUser($id){
        $conecta = new mysqli($this->endereco, $this->login, $this->senha, $this->database);

        $consulta = $conecta->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $resultado = $consulta->get_result();
        $user = $resultado->fetch_assoc();
        $consulta->close();
        $this->id = $user["idUsuario"];
        $this->nome = $user["nome"];
        $this->senhaUser = $user["senha"];
        $this->email = $user["email"];

    }

    public function getAll(){
        $conecta = new mysqli($this->endereco, $this->login, $this->senha, $this->database);

        $consulta = $conecta->prepare("SELECT * FROM usuario");
        $consulta->execute();
        $resultado = $consulta->get_result();
        $user = $resultado->fetch_all();
        $consulta->close();
        $this->users= $user;

    }

    public function deleteUser($id){
        $conecta = new mysqli($this->endereco, $this->login, $this->senha, $this->database);

        $consulta = $conecta->prepare("DELETE FROM usuario WHERE idUsuario = ?");
        $consulta->bind_param('i', $id);
        $consulta->execute();
        $consulta->close();

    }

    public function updateUser($id,$email, $nome, $senhaUser){
        $conecta = new mysqli($this->endereco, $this->login, $this->senha, $this->database);

        $insere = $conecta->prepare("UPDATE usuario SET nome=?,email=?,senha=? where idUsuario=?");
        $insere->bind_param('sssi', $nome,$email,$senhaUser,$id );
        $insere->execute();
        $insere->close();
    }


    public function verificaLogin($email,$senha)
    {
        $conecta = new mysqli($this->endereco, $this->login, $this->senha, $this->database);
        $veflogin = $conecta->prepare("SELECT * FROM usuario WHERE email = ? LIMIT 1 ");
        $veflogin->bind_param("s", $email );
        $veflogin->execute();
        $resultado = $veflogin->get_result();
        $user = $resultado->fetch_assoc();
        $veflogin->close();
        return password_verify($senha, $user['senha']);
    }

    public function getEmail($email)
    {
        $conecta = new mysqli($this->endereco, $this->login, $this->senha, $this->database);
        $veflogin = $conecta->prepare("SELECT * FROM usuario WHERE email = ? LIMIT 1 ");
        $veflogin->bind_param("s", $email );
        $veflogin->execute();
        $resultado = $veflogin->get_result();
        $user = $resultado->fetch_assoc();
        $veflogin->close();
        return $user['email'];
    }

    public function existeUser($email)
    {
        $verifica= new mysqli($this->endereco, $this->login, $this->senha, $this->database);
        $verifica2 = $verifica->prepare("SELECT * FROM usuario WHERE email = ? ");
        $verifica2->bind_param("s", $email );
        $verifica2->execute();
        $verificaRes = $verifica2->get_result();
        $this->exiteUser = $verificaRes->fetch_row();
        $verifica2->close();
    }


}