<?php

class DatabaseTable{

    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct(PDO $pdo, string $table, string $primaryKey){

        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    private function query($sql, $parameters = []){
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);    
        return $query;
    }
    
    public function totalJokes(){
        $sql=  'SELECT COUNT(*) FROM `'.$this->table.'`';
        $query = $this->query($this->pdo,$sql);
        $row = $query->fetch();
        return $row[0];
    }
    
    private function processDates($fields){
        foreach($fields as $key => $value){
            if($value instanceof DateTime){
                $fields[$key] = $value->format('Y-m-d H:i:s');
            }
        }
        return $fields;
    }

    private function insert($fields){
    
        $sql = 'INSERT INTO '.'`' . $this->table . '`' . '(';
    
        foreach($fields as $key => $value){
            $sql .= '`' . $key . '` ,';
        }
    
        $query = rtrim($sql, ',');
        $query .=')VALUES(';
    
        foreach($fields as $key => $value){
            $sql .= ':' .$key .',';
        }
    
        $query = rtrim($sql, ',');
        $query .=')';
    
        $fields = $this->processDates($fields);
    
        $this->query($query,$fields);
    }
    
    
    private function update($fields){
    
        $query = 'UPDATE'.'`' . $this->table . '` ' . 'SET ';
    
        foreach($fields as $key => $value){
            $query .= '`' .$key. '` =:' .$key .',';
        }
    
        $query = rtrim($query, ',');
    
        $query .= ' WHERE `'.$this->primaryKey.'` = :primaryKey';
    
        $fields['primaryKey'] = $fields['id'];
        
        $fields = $this->processDates($fields);   
        
        $this->query($query,$fields);
    
    }
    
    public function findById($value){     
    
        $sql = 'SELECT * FROM ' .'`' . $this->table .'`WHERE `'.$this->primaryKey.'` = :value';
    
        $parameters = [
            'value' => $value
        ];
    
        $query = $this->query($pdo,$sql,$parameters);
    
        return $query->fetch();
    
    }
    
    public function findAll($pdo, $table){ 
    
        $sql = 'SELECT * FROM ' .'`' . $this->table .'`';
    
        $query = $this->query($pdo,$sql);
    
        return $query->fetchAll();
    
    }
    
    
    public function delete($id){
    
        $parameters = [
            ':id' => $id
        ];
    
        $sql = 'DELETE  FROM ' .'`' . $This->table .'`'. 'WHERE `'. $$this->primaryKey .'`=:id';
    
        $this->query($sql,$parameters);
    }
    
    public function save($pdo, $table, $primaryKey, $record){
        try{
            if($record[$this->primaryKey]== ''){
                $record[$this->primaryKey] = null;
            }
            $this->insert($record);
        }
        catch(PDOException $e){
            $this->update($record);        
        }
    }

}