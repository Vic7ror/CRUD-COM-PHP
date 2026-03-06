<?php 

namespace model;
class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $dt_nascimento;
    private $dt_cadastro;
    private $dt_atualizacao;
    private $ativo;

    private $con;
    public function __construct()
    {
        try {
            $this->con = new \PDO(SERVIDOR, USUARIO, SENHA);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            if (strpos($e->getMessage(), 'could not find driver') !== false) {
                throw new \Exception(
                    "PDO MySQL driver não encontrado. " .
                    "Você precisa instalar/habilitar a extensão PDO MySQL no PHP.\n" .
                    "No Windows, verifique se php_pdo_mysql.dll está na pasta ext/ e habilitado no php.ini\n" .
                    "Execute: php -m | findstr pdo_mysql para verificar se está instalado"
                );
            }
            throw $e;
        }
    }

    private function consultaSeEmailExiste()
    {
        if (empty($this->email)) {
            return false;
        }

        try {
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':email', $this->email, \PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro na consulta de email: " . $e->getMessage());
            return false;
        }
    }

    private function consultaSeIdExiste()
    {
        if (empty($this->id)) {
            return false;
        }

        try {
            $sql = "SELECT * FROM usuario WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro na consulta de ID: " . $e->getMessage());
            return false;
        }
    }

    public function create(){
        // Verificar se todos os campos obrigatórios estão preenchidos
        if (empty($this->nome) || empty($this->email) || empty($this->senha) || empty($this->dt_nascimento)) {
            throw new \Exception("Todos os campos obrigatórios devem ser preenchidos");
        }
        
        // Verificar se o email já está cadastrado
        $usuarioExistente = $this->consultaSeEmailExiste();
        if ($usuarioExistente) {
            throw new \Exception("Email já cadastrado no sistema");
        }
        
        try {
            // Hash da senha
            $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
            
            // Preparar SQL para inserção
            $sql = "INSERT INTO usuario (nome, email, senha, dt_nascimento) 
                    VALUES (:nome, :email, :senha, :dt_nascimento)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nome', $this->nome, \PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, \PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senhaHash, \PDO::PARAM_STR);
            $stmt->bindParam(':dt_nascimento', $this->dt_nascimento, \PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $this->id = $this->con->lastInsertId();
                return true;
            }
            
            return false;
            
        } catch (\PDOException $e) {
            error_log("Erro ao criar usuário: " . $e->getMessage());
            throw new \Exception("Erro ao cadastrar usuário");
        }
    }

    public function update()
    {
        // Verificar se o ID existe
        $usuarioExistente = $this->consultaSeIdExiste();
        if (!$usuarioExistente) {
            throw new \Exception("Usuário não encontrado para atualização");
        }
        
        // Verificar se pelo menos um campo foi alterado
        if (empty($this->nome) && empty($this->email) && empty($this->senha) && empty($this->dt_nascimento)) {
            throw new \Exception("Pelo menos um campo deve ser preenchido para atualização");
        }
        
        try {
            // Construir a query dinamicamente baseada nos campos preenchidos
            $sql = "UPDATE usuario SET ";
            $setParts = [];
            $params = [];
            
            if (!empty($this->nome)) {
                $setParts[] = "nome = :nome";
                $params[':nome'] = $this->nome;
            }
            
            if (!empty($this->email)) {
                // Verificar se o novo email já existe (exceto para o usuário atual)
                if ($this->email !== $usuarioExistente['email']) {
                    $this->setEmail($this->email);
                    $emailExistente = $this->consultaSeEmailExiste();
                    if ($emailExistente) {
                        throw new \Exception("Email já cadastrado no sistema");
                    }
                }
                $setParts[] = "email = :email";
                $params[':email'] = $this->email;
            }
            
            if (!empty($this->senha)) {
                $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
                $setParts[] = "senha = :senha";
                $params[':senha'] = $senhaHash;
            }
            
            if (!empty($this->dt_nascimento)) {
                $setParts[] = "dt_nascimento = :dt_nascimento";
                $params[':dt_nascimento'] = $this->dt_nascimento;
            }
            
            $setParts[] = "dt_atualizacao = NOW()";
            
            $sql .= implode(", ", $setParts);
            $sql .= " WHERE id = :id";
            $params[':id'] = $this->id;
            
            $stmt = $this->con->prepare($sql);
            
            // Bind dos parâmetros
            foreach ($params as $key => $value) {
                $paramType = ($key === ':id') ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $stmt->bindValue($key, $value, $paramType);
            }
            
            if ($stmt->execute()) {
                return true;
            }
            
            return false;
            
        } catch (\PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            throw new \Exception("Erro ao atualizar usuário");
        }
    }

    public function delete()
    {
        // Verificar se o ID existe
        $usuarioExistente = $this->consultaSeIdExiste();
        if (!$usuarioExistente) {
            throw new \Exception("Usuário não encontrado para exclusão");
        }
        
        try {
            // Preparar SQL para exclusão
            $sql = "DELETE FROM usuario WHERE id = :id";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return true;
            }
            
            return false;
            
        } catch (\PDOException $e) {
            error_log("Erro ao excluir usuário: " . $e->getMessage());
            throw new \Exception("Erro ao excluir usuário");
        }
    }

    public function all()
    {
        try {
            $sql = "SELECT id, nome, email, dt_nascimento, dt_cadastro, dt_atualizacao, ativo FROM usuario ORDER BY id ASC";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao listar usuários: " . $e->getMessage());
            throw new \Exception("Erro ao listar usuários");
        }
    }

    public function find(){
        if (empty($this->id)) {
            throw new \Exception("ID do usuário não foi definido");
        }
        try {
            $sql = "SELECT id, nome, email, senha, dt_nascimento, dt_cadastro, dt_atualizacao, ativo 
                    FROM usuario 
                    WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);
            $stmt->execute();
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$usuario) {
                throw new \Exception("Usuário não encontrado");
            }
            return $usuario;
        } catch (\PDOException $e) {
            error_log("Erro ao buscar usuário: " . $e->getMessage());
            throw new \Exception("Erro ao buscar usuário");
        }
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getDtNascimento()
    {
        return $this->dt_nascimento;
    }

    public function getDtCadastro()
    {
        return $this->dt_cadastro;
    }

    public function getDtAtualizacao()
    {
        return $this->dt_atualizacao;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setDtNascimento($dt_nascimento)
    {
        $this->dt_nascimento = $dt_nascimento;
    }

    public function setDtCadastro($dt_cadastro)
    {
        $this->dt_cadastro = $dt_cadastro;
    }

    public function setDtAtualizacao($dt_atualizacao)
    {
        $this->dt_atualizacao = $dt_atualizacao;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}
