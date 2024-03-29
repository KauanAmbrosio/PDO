<?php
    abstract class Crud{
        protected $tabela;
        abstract function inserir();
        abstract function atualizar($campo, $id);

        public function listar(){
            $sqlSelect = "select * from {$this->tabela}";
            $stmt = Conexao::prepare($sqlSelect);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function buscar($campo, $id){
            $sqlSelect = "select * from {$this->tabela} where $campo=:parametro";
            $stmt =  Conexao::prepare($sqlSelect);
            $stmt->bindParam(':parametro',$id,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();            
        }

        public function deletar($campo, $id){
            $sqlDelete = "delete from {$this->tabela} where $campo=:idDel";
            $stmt = Conexao::prepare($sqlDelete);
            $stmt->bindParam(':idDel',$id,PDO::PARAM_INT);
            $stmt->execute();
        }

        public function listaOrdenada($campo, $tipo = 'C'){
            
            $sqlLista = "SELECT * FROM {$this->tabela} ORDER BY :campo ";

            if ($tipo === 'D' ){
                $sqlLista .= ' desc';
            }

            $stmt = Conexao::prepare($sqlLista);
            $stmt->bindParam(':campo',$campo,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }