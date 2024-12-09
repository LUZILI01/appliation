<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {   $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // 创建权限
        $editPermission = Permission::firstOrCreate(['name' => 'edit posts']);
        $publishPermission = Permission::firstOrCreate(['name' => 'publish posts']);

        // 给角色分配权限
        $adminRole->givePermissionTo([$editPermission, $publishPermission]);
        $editorRole->givePermissionTo($editPermission);

        // 创建并分配角色给特定用户
        $adminUser = User::firstOrCreate(['name' => 'admin'], [
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@1.com', 
            'email_verified_at' => now(),
            'password' => bcrypt('1111111'),  
            'remember_token' => Str::random(10),
        ]);
        $adminUser->assignRole($adminRole);

        $editorUser = User::firstOrCreate(['name' => 'editor'], [
            'name' => 'editor',
            'username' => 'editor',
            'email' => 'editor@2.com', 
            'email_verified_at' => now(),
            'password' => bcrypt('1111111'),  
            'remember_token' => Str::random(10),
        ]);
        $editorUser->assignRole($editorRole);


        Post::factory(10)->create();
        
        // User::truncate();
        // Category::truncate();
        // Post::truncate();
        // $user=User::factory()->create([
//'name'=>'John Doe' 
        // ]);

        // $personal=Category::create([
        //     'name'=>'Personal',
        //     'slug'=>'personal'

        // ]
        // );
        // $family=Category::create([
        //     'name'=>'Family',
        //     'slug'=>'family'

        // ]);
        // $work=Category::create([
        //     'name'=>'Work',
        //     'slug'=>'work'

        // ]);
        
        // Post::create([
        //     'user_id'=>$user->id,
        //     'category_id'=>$family->id,
        //     'title'=>'My Family Post',
        //     'slug'=>'my-first-post',
        //     'excerpt'=>'<p>Here is Jonny!!!</p>',
        //     'body'=>'<p>Jonny is here???</p>',


        // ]);
        // Post::create([
        //     'user_id'=>$user->id,
        //     'category_id'=>$work->id,
        //     'title'=>'My Work Post',
        //     'slug'=>'my-work-post',
        //     'excerpt'=>'<p>Here is Jonny!!!</p>',
        //     'body'=>'<p>Jonny is here???</p>',

        // ]); 
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}