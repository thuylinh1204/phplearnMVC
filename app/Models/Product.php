<?php
namespace App\Models;

class Product extends DbConnect
{
    public function get()
    {
        $sql ="SELECT * FROM products WHERE 1;";
        try{
            // use exec() because no results are returned
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;

        } catch(\PDOException $e) {
            //die( $sql . "<br>" . $e->getMessage());
            return false;
        }
    }

    public function find($id)
    {
        $sql ="SELECT * FROM products WHERE id = ?;";
        try{
            // use exec() because no results are returned
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);

        } catch(\PDOException $e) {
            // die( $sql . "<br>" . $e->getMessage());
            return false;
        }

        $product = $stmt->fetch(\PDO::FETCH_OBJ);

        return $product;
    }
}