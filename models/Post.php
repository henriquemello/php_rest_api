<?php

    class Post{

        //DB stuff
        private $conn;
        private $table='posts';

        //Post Properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        //Construtor
        public function __construct($db){
            $this->conn= $db;
        }



        //Get Posts
        public function read(){

            $query =' SELECT 
                        C.name as category_name,
                        P.id,
                        P.category_id,
                        P.title,
                        P.body,
                        P.author,
                        P.created_at
                    FROM ' . $this->table . ' P
                    LEFT JOIN 
                        categories C  ON P.category_id = C.id
                    ORDER BY 
                        P.created_at DESC;';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute
            $stmt->execute();


            return $stmt;

        }

        //Buscar Post por id
        public function read_single(){

            $query =' SELECT 
                        C.name as category_name,
                        P.id,
                        P.category_id,
                        P.title,
                        P.body,
                        P.author,
                        P.created_at
                    FROM ' . $this->table . ' P
                    LEFT JOIN 
                        categories C  ON P.category_id = C.id
                    WHERE
                        P.id = ?
                    LIMIT 0,1;';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Binding value
            $stmt->bindParam(1,$this->id);

            //Execute
            $stmt->execute();


            $row =  $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            $this->created_at = $row['created_at'];
        }

        //Criar Post
        public function create(){


            $query= ' INSERT INTO ' . $this->table . '
                        SET title = :title,
                            body = :body,
                            author = :author,
                            category_id = :category_id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);


            //Limpar Dados maliciosos
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            //Bind data
            $stmt->bindParam(':title',$this->title);
            $stmt->bindParam(':body',$this->body);
            $stmt->bindParam(':author',$this->author);
            $stmt->bindParam(':category_id',$this->category_id);

            //Execute
            if($stmt->execute()){
                return true;
            }


            //throw error
            printf("Erro: %s.\n",$stmt->error); 

            return false;
        }

         //atualizar Post
         public function update(){

            $query= ' UPDATE ' . $this->table . '
                        SET title = :title,
                            body = :body,
                            author = :author,
                            category_id = :category_id
                        WHERE id = :id';

            //Preparar para executar
            $stmt = $this->conn->prepare($query);


            //Limpar Dados maliciosos
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Carregar dados
            $stmt->bindParam(':title',$this->title);
            $stmt->bindParam(':body',$this->body);
            $stmt->bindParam(':author',$this->author);
            $stmt->bindParam(':category_id',$this->category_id);
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

            //Prepare statement
            $stmt = $this->conn->prepare($query);


            //Limpar Dados maliciosos
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
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
