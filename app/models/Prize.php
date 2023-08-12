<?php


namespace app\models;


class Prize extends Model
{
    public function getAll() : array
    {
        $stmt = $this->db->query("SELECT `name`, `id`, `name`, `count`, `image`, `description` FROM `prizes`");
        return $stmt = $stmt->fetchAll(\PDO::FETCH_UNIQUE);
    }

    public function subtract(int $id) : void
    {
        $stmt = $this->db->prepare("SELECT `count` FROM `prizes` WHERE `id` = :id");
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch()[0];

        if($res > 0) {
            $res--;
            $stmt = $this->db->prepare("UPDATE prizes SET `count` = :count WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":count", $res);
            $stmt->execute();
        }
    }

    public function addPrizeInToUser(int $user_id, int $prize_id) : int
    {
        $stmt = $this->db->prepare("SELECT `count` FROM `users_prizes` WHERE `user_id` = :user_id AND `prize_id` = :prize_id");
        $stmt->execute(['user_id' => $user_id, 'prize_id' => $prize_id]);
        $count = $stmt->fetch();

        if(!$count) {
            $count = 1;
            $sql = 'INSERT INTO users_prizes(count, user_id, prize_id) VALUES(:count, :user_id, :prize_id)';
        } else {
            $count = $count['count'];
            $count++;
            $sql = 'UPDATE users_prizes SET `count` = :count WHERE user_id = :user_id AND prize_id = :prize_id';
        }


        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':prize_id', $prize_id);
        $stmt->bindValue(':count', $count);
        $stmt->execute();

        return $count;
    }
}