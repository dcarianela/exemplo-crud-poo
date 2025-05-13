<?php 
namespace ExemploCrud\Services;

use Exception, PDO, Throwable;
use ExemploCrud\Database\ConexaoBD;
use ExemploCrud\Models\Fabricante;

final class FabricanteServico {
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function listarTodos():array {
        $sql = "SELECT * FROM fabricantes ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar fabricantes: ".$erro->getMessage());
        }
    }

    public function inserir(Fabricante $fabricante): void {
        $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $fabricante->getNome(), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao inserir: ".$erro->getMessage());
        }
    }

    public function buscarPorId(int $id): ?array {
        $sql = "SELECT * FROM fabricantes WHERE id = :id";
 
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

            /* Versão usando ternário simplificado usando 'elvis operator' */
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;

        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar fabricante: " . $erro->getMessage());
        }
    }

    public function atualizar(Fabricante $fabricante):void {
        $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $fabricante->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":id", $fabricante->getId(), PDO::PARAM_INT);
            $consulta->execute();

        } catch (Throwable $erro) {
            throw new Exception("Erro ao atualizar o nome do fabricante: ".$erro->getMessage());
        }
    }

    public function excluir(int $id): void {
        $sql = "DELETE FROM fabricantes WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();

        } catch (Throwable $erro) {
            throw new Exception("Erro ao excluir fabricante: ".$erro->getMessage());
        }
    }

} // final da classe 
