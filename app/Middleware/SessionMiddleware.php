<?php

    class SessionMiddleware {

        public function run($request){
            if(isset($_SESSION['username_id'])){
                $request->user = new StdClass();
                $request->user->id = $_SESSION['username_id'];
                $request->user->username = $_SESSION['user_name'];   
            } else {
                $request->user = null;
            }
            return $request;
        }

    }