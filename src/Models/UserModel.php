<?php
class UserModel
{
    use Database;

    public function getAllUsers()
    {
        $rs = $this->table('user')->getAll();
        return $rs;
    }
    public function getUserByUsername($username)
    {
        $rs = $this->table('user')
            ->get("username", "$username");
        if ($rs == null) {
            return null;
        }
        return $rs;
    }
    public function getUserById($user_id)
    {
        $rs = $this->table('user')
            ->get("user_id", "$user_id");
        if ($rs == null) {
            return null;
        }
        return $rs;
    }
    public function updateUserById($user_id, $username, $password, $name, $role)
    {
        $rs = $this->table("user")
            ->update('user_id', $user_id, [
                'username' => $username,
                'password' => $password
            ]);
        return $rs;
    }
    public function deleteUserById($user_id)
    {
        $rs = $this->table("user")
            ->delete('user_id', $user_id);
        return $rs;
    }
    public function addUser($user_id, $username, $password, $name, $role)
    {
        $rs = $this->table("user")
            ->insert([
                'user_id' => $user_id,
                'username' => $username,
                'password' => $password
            ]);
        return $rs;
    }
    public function createNewUser($username, $password)
    {
        $rs = $this->table("user")
            ->insert([
                "username" => $username,
                "password" => $password
            ]);
    }
}
