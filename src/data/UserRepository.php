<?php

class UserRepository
{

    function getAll()
    {
        return json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users"));
    }

    function singleUser($id)
    {
        return json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users/$id"));
    }
}
