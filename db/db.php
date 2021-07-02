<?php 

  class Database{
    private $db; 

    private $credentials = array(
      'user' => 'root',
      'pass' => 'rakoon',
      'db'   => 'karakuzo_acp',
      'host' => 'localhost'
    );
    private $table = 'houses';
    private $primaryKey = 'id';
    private $columns = array(
      array( 'db' => 'id', 'dt' => 1 ),
      array( 'db' => 'house_name', 'dt' => 2 ),
      array( 'db' => 'address', 'dt' => 3 ),
      array( 'db' => 'description', 'dt' => 4 ),
      array( 'db' => 'price', 'dt' => 5 ),
      array( 'db' => 'room', 'dt' => 6 ),
      array( 'db' => 'house_type', 'dt' => 7 )
    );

    public function __construct(){
      try{
        $pdo = new PDO(
          'mysql:host='.$this->credentials['host']
          .';port=3306;dbname='.$this->credentials['db'],
          $this->credentials['user'], 
          $this->credentials['pass']
        );
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db = $pdo;
      } catch(PDOException $e){
        die($e->getMessage());
      }
    }

    public function getDropdownItems($type){
      $stmt = ($type == "rooms") ? $this->db->prepare("SELECT room FROM houses GROUP BY room ORDER BY room")
        : $this->db->prepare("SELECT house_type FROM houses GROUP BY house_type ORDER BY house_type");
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeHouse($id){
      $stmt = $this->db->prepare("DELETE FROM houses WHERE id = :id");
      $stmt->bindValue(':id', $id);
      $stmt->execute();
    }

    public function addHouse($POST){
      $stmt = $this->db->prepare("
        INSERT INTO houses(house_name, address, description, price, room, house_type) 
        VALUES(:house_name, :address, :description, :price, :room, :house_type)
      ");
      
      foreach($POST as $name => $value)
        $stmt->bindValue(":$name", $value);

      $stmt->execute();
    }

    public function updateHouse($POST){
      $stmt = $this->db->prepare("UPDATE houses SET 
        house_name = :house_name, 
        address = :address,
        description = :description,
        price = :price,
        room = :room,
        house_type = :house_type WHERE id = :id
      ");
      
      foreach($POST as $name => $value)
        $stmt->bindValue(":$name", $value);

      $stmt->execute();
    }

    public function getTableRequirements(){
      return [$this->credentials, $this->table, $this->primaryKey, $this->columns];
    }
    /***********************************
    **********DB CHARTS SECTION*********
    ************************************/
    public function getHousetypeCount(){
      $stmt = $this->db->prepare("SELECT house_type, COUNT(house_type) as count FROM houses");
      $stmt->execute();

      return $stmt;
    }

    public function getDataForChart($type){
      if($type == "pricesOfTypesPie")
        $stmt = $this->db->prepare("SELECT house_type, SUM(price) as price FROM houses GROUP BY house_type");
      else if($type == "%ofTypes")
        $stmt = $this->db->prepare("SELECT house_type, COUNT(house_type) as count FROM houses GROUP BY house_type");
      else if($type == "comparison")
        $stmt = $this->db->prepare("SELECT name, price FROM history");
      else if($type == "analyze")
        $stmt = $this->db->prepare("SELECT name, price, date FROM history WHERE name='penthouse 03'");
      
      $stmt->execute();
      return $stmt;
    }

    public function getSum(){
      $stmt = $this->db->prepare("SELECT COUNT(house_type) as sum FROM houses");
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getComparisonCategories(){
      $stmt = $this->db->prepare("SELECT DATE_FORMAT(date,'%m/%y') AS date FROM history GROUP BY date;");
      $stmt->execute();

      $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $dates = [];
      foreach($stmt as $row)
        $dates[] = $row["date"];
      return $dates;
    }


    
  }
  
?>