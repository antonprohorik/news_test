<?php

namespace Model;

use PDO;

class ModelNews
{
    public function getCount()
    {
        $sql = "SELECT COUNT(id) FROM news";
        $sth = \DB::conn()->prepare($sql);
        $sth->execute();
        return $sth->fetchColumn();
    }

    public function getRows($limit, $offset = 0)
    {
        $sql = "SELECT * FROM news ORDER BY date DESC LIMIT :offset, :limit";
        $sth = \DB::conn()->prepare($sql);
        $sth->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sth->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function getItem($id)
    {
        $sql = "SELECT * FROM news WHERE id = :id";
        $sth = \DB::conn()->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch();
    }

    public function getLast()
    {
        return $this->getRows(1);
    }
}