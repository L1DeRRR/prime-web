<?php

namespace App\Modules;

use PDO;

class Module
{
    private $pdoGame;
    private $pdoForum;

    public function __construct()
    {
        $configGame = require HOMEDIR . "/config/configGame.php";
        $configForum = require HOMEDIR . "/config/configForum.php";
        if ($configGame['enable']) {
            $dsn = 'mysql:host=' . $configGame['db_host'] . ';dbname=' . $configGame['db_name'];
            $username = $configGame['db_user'];
            $password = $configGame['db_pass'];

            try {
                $this->pdoGame = new PDO($dsn, $username, $password);
                $this->pdoGame->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('error: ' . $e->getMessage());
            }
        }
        if ($configForum['enable']) {
            $dsn = 'mysql:host=' . $configForum['db_host'] . ';dbname=' . $configForum['db_name'];
            $username = $configForum['db_user'];
            $password = $configForum['db_pass'];

            try {
                $this->pdoForum = new PDO($dsn, $username, $password);
                $this->pdoForum->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('error: ' . $e->getMessage());
            }
        }
    }

    public function getUsersPvp($limit)
    {
        $table = 'characters';
        $stmt = $this->pdoGame->prepare("SELECT * FROM $table ORDER BY pvpkills DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getForumTopic($limit)
    {
        $table = 'forums_topics';
        $stmt = $this->pdoForum->prepare("SELECT * FROM $table ORDER BY start_date DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $topics;
    }
    public function getTopicAuthor($id)
    {
        $authors = [];
        $table = 'core_members';
        $stmt = $this->pdoForum->prepare("SELECT `name`,`pp_thumb_photo` FROM $table WHERE member_id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $authors[] = $row;
        }
        return $authors;
    }

    public function getOnlineGame() {
        $table = 'characters';
        $stmt = $this->pdoGame->query("SELECT SUM(online) AS total_online  FROM $table");
        $stmt->execute();
        $onlineGame = $stmt->fetch(PDO::FETCH_ASSOC);
        return $onlineGame;
    }

    public function getСastleEndOwner()
    {
        $table = 'castle';
        $table1 = 'clan_data';
        $table2 = 'clan_subpledges';
        $table3 = 'characters';
        $stmt = $this->pdoGame->query("SELECT castle.name, characters.char_name
        FROM $table
        JOIN $table1 ON clan_data.hasCastle = castle.id
        JOIN $table2 ON clan_subpledges.clan_id = clan_data.clan_id
        JOIN $table3 ON characters.obj_Id = clan_subpledges.leader_id");
        $stmt->execute();
        $castles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $castles;
    }



}
