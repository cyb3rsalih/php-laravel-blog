<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ["Hakkımızda","Kariyer","Vizyon","Misyonumuz"];
        $count = 0;
        foreach($pages as $page){
            DB::table('pages')->insert(
                [
                    "title"=>$page,
                    "slug"=>str_slug($page,"-"),
                    "image"=>"https://thumbor.forbes.com/thumbor/960x0/https%3A%2F%2Fblogs-images.forbes.com%2Fkellyhoey%2Ffiles%2F2018%2F08%2Fdesk-3139127_1920-1200x773.jpg",
                    "content"=>"Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Et cumque vitae voluptatem blanditiis quas 
                                officiis esse voluptatibus, aliquid dignissimos nostrum ea
                                corrupti eaque magni eum quisquam.
                                Obcaecati molestiae neque mollitia!",
                    "order"=>$count,
                    "created_at"=>now(),
                    "updated_at"=>now()
                ]
                );
        }
    }
}
