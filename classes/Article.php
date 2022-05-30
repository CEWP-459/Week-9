<?php

class Article
{
    public $id;
    public $title;
    public $content;
    public $published_at;
    public $errors = [];

    protected function validate () {

        if ($this -> title == '') {
            $this -> errors[] = 'Title is required';
        }
        if ($this -> content == '') {
            $this -> errors[] = 'Content is required';
        }

        if ($this -> published_at != '') {
            $date_time = date_create_from_format('Y-m-d H:i:s', $this -> published_at);

            if ($date_time === false) {
                $this -> errors[] = 'Invalid date and time';
            } else {
                $date_errors = date_get_last_errors();

                if ($date_errors['warning_count'] > 0) {
                    $this -> errors[] = 'Invalid date and time';
                }
            }
        }

        return empty($this -> errors);
    
    }

    public static function getAll ($connection) {
        $sql = "SELECT * FROM article"; 
        $result = $connection -> query($sql); 
        return $result -> fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function getById ($connection, $id, $columnName = "*") {
        $sql = "SELECT $columnName FROM article WHERE id = :id";
    
        $stmt = $connection -> prepare($sql);
        $stmt -> bindValue(":id", $id, PDO::PARAM_INT);
    
        $stmt -> setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt -> execute()) {
            return $stmt -> fetch();
        } 
    }

    public function update ($connection) {

        if ($this -> validate()) {

            $sql = "UPDATE  article 
                    SET     title = :title, 
                            content = :content, 
                            published_at = :published_at
                    WHERE   id = :id";

            $stmt = $connection -> prepare($sql);

            $stmt -> bindValue(':id', $this -> id, PDO::PARAM_INT);
            $stmt -> bindValue(':title', $this -> title, PDO::PARAM_STR);
            $stmt -> bindValue(':content', $this -> content, PDO::PARAM_STR);

            if ($this -> published_at == '') {
                $stmt -> bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt -> bindValue(':published_at', $this -> published_at, PDO::PARAM_STR);
            }

            return $stmt -> execute();
       
        } else {

            return false;

        }

    }

    public function delete ($connection) {

        $sql = "DELETE FROM article WHERE id = :id";

        $stmt = $connection -> prepare($sql);

        $stmt -> bindValue(':id', $this -> id, PDO::PARAM_INT);

        return $stmt -> execute();

    } 

    public function create ($connection) {

        if ($this -> validate()) {

            $sql = "INSERT INTO article (title, content, published_at)
                    VALUES (:title, :content, :published_at)";

            $stmt = $connection -> prepare($sql);

            $stmt -> bindValue(':title', $this -> title, PDO::PARAM_STR);
            $stmt -> bindValue(':content', $this -> content, PDO::PARAM_STR);

            if ($this -> published_at == '') {
                $stmt -> bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt -> bindValue(':published_at', $this -> published_at, PDO::PARAM_STR);
            }

            if ($stmt -> execute()) {
                $this -> id = $connection -> lastInsertId();
                return true;
            }
       
        } else {

            return false;

        }

    }

}
