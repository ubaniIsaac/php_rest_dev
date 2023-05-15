<?php 

class Category {
    
    private $conn;
    private $table = 'categories';

    public $id;
    public $name;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM '. $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single(){

        $query = 'SELECT * FROM '. $this->table . '
         WHERE id =? 
         LIMIT 0,1';

         $stmt = $this->conn->prepare($query);

         $stmt->bindParam(1, $this->id);

         $stmt->execute();
          
          return $stmt;
    }

    public function create(){
        //write query
        $query = 'INSERT INTO ' . $this->table . '(name) values (:name)';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data (htmlspecialchars)
        $this->name = htmlspecialchars(strip_tags($this->name));

        //bindparams
        $stmt->bindParam(':name', $this->name);

        //execute
        if($stmt->execute()) {
            return true;

    }
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  public function update(){
    $query = 'UPDATE ' . $this->table . ' SET name = :name
    WHERE id = :id ';

    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));

    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()) {
        return true;

    }
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
  public function delete(){
    $query = 'DELETE FROM '. $this->table . '
    WHERE id = ?';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);
    
    if($stmt->execute()) {
        return true;

    }
    printf("Error: %s.\n", $stmt->error);

    return false;
  }



}