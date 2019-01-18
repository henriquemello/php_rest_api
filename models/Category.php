<?php

    class Category{

        //tabela
        private $conn;
        private $table='categories';

        //Propriedades
        public $id;
        public $name;
        public $created_at;

        //Construtor
        public function __construct($db){
            $this->conn= $db;
        }



        //Buscar todas as categorias
        public function read(){

            $query =' SELECT 
                        C.id,
                        C.name, 
                        C.created_at
                    FROM ' . $this->table . ' C
                    ORDER BY 
                        C.created_at DESC;';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();


            return $stmt;

        }

        //Buscar Categoria por id
        public function read_single(){

            $query =' SELECT 
                        C.id,
                        C.name, 
                        C.created_at
                    FROM ' . $this->table . ' C
                    WHERE
                        P.id = ?
                    LIMIT 0,1;';

            //Preparar statement
            $stmt = $this->conn->prepare($query);

            //Preenchendo o valor
            $stmt->bindParam(1,$this->id);

            //Execute
            $stmt->execute();


            $row =  $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->created_at = $row['created_at'];
        }

        //Criar Categoria
        public function create(){


            $query= ' INSERT INTO ' . $this->table . '
                        SET name = :name ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);


            //Limpar Dados maliciosos
            $this->name = htmlspecialchars(strip_tags($this->name));

            //Carregar dados
            $stmt->bindParam(':name',$this->name);


            //Execute
            if($stmt->execute()){
                return true;
            }


            //throw error
            printf("Erro: %s.\n",$stmt->error); 

            return false;
        }

         //atualizar categoria
         public function update(){

            $query= ' UPDATE ' . $this->table . '
                        SET name = :name
                        WHERE id = :id';

            //Prepare to execute
            $stmt = $this->conn->prepare($query);

 
            //Limpar Dados maliciosos
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':name',$this->name);
            $stmt->bindParam(':id',$this->id);

            //Execute
            if($stmt->execute()){
                return true;
            }


            //throw error
            printf("Erro: %s.\n",$stmt->error); 

            return false;

         }

         public function delete(){


            $query= ' DELETE FROM ' . $this->table . ' WHERE id = :id';

            //Preparar statement
            $stmt = $this->conn->prepare($query);


            //Limpar Dados maliciosos
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Carregar dados
            $stmt->bindParam(':id',$this->id);

            //Execute
            if($stmt->execute()){
                return true;
            }


            //throw error
            printf("Erro: %s.\n",$stmt->error); 

            return false;

         }
    }
?>
