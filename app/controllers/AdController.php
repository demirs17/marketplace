<?php

namespace App\Controllers;

use App\Models\Ad;

class AdController{

    public function create(){
        Ad::new([
            "title" => "başlık",
            "images_folder" => uniqid(),
            "description" => "açıklama",
            "user_id" => 1,
            "price" => 750000,
            "category" => 2,
            "subcategory" => 4
        ]);
    }
    public function getByCategory($request){
        if(!empty($request["category"])){
            //category = subcategory
            echo "<pre>";
            print_r(Ad::select("select *, ads.id as id from ads, subcategories where ads.subcategory = subcategories.id and subcategories.subcategory_name = '" . $request["category"] . "'"));
            echo "</pre>";
        }else if(!empty($request["parentCategory"])){
            //parentCategory = category;
            echo "<pre>";
            print_r(Ad::select("select *, ads.id as id from ads, categories where ads.category = categories.id and categories.category_name = '" . $request["parentCategory"] . "'"));
            echo "</pre>";
        }else{
            redirect("/");
        }
    }
    public function paginate($request){
        $per_page = 10;
        $page = $request["page"];
        $sql = "select * from ads order by created_at desc LIMIT " . $per_page . " OFFSET " . ($page-1) * $per_page;
        echo "<pre>";
        print_r(Ad::select($sql));
        echo "</pre>";
    }
}
