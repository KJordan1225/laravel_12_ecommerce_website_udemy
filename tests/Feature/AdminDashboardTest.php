<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;
	
	public function add_category_return_id()
	{
		$formData = [
			'name' => 'Category 1',
		];
		
		Category::create($formData);		
		$categoryId = Category::where('name', 'Category 1')->value('id');		
		return $categoryId;	
	}
	
	public function add_subcategory_return_id($categoryId)
	{

		// Create Subcategory record
		$formData = [
			'name' => 'Subcategory 1',
			'category_id' => $categoryId,
		];		
		Subcategory::create($formData);		
		$subcategoryId = Subcategory::where('name', 'Subcategory 1')->value('id');
		return $subcategoryId;			
	}
	
	
	public function add_childcategory_return_id($subcategoryId)
	{
		
		// Create Childcategory record
		$formData = [
			'name' => 'Child Category 1',
			'subcategory_id' => $subcategoryId,
		];		
		Childcategory::create($formData);		
		$childcategoryId = Childcategory::where('name', 'Child Category 1')->value('id');
		return $childcategoryId;		
	}
    
    public function test_admin_index_page_renders()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);
		
		// Create a user with known credentials
        $admin = Admin::factory()->create([
            'email' => 'shadow902@gmail.com',
            'password' => bcrypt('Welc0me!1225'),
        ]);
		
		// Simulate login request
        $response = $this->post('admin/auth', [
            'email' => 'shadow902@gmail.com',
            'password' => 'Welc0me!1225',
        ]);
		
		$response->assertRedirect(route('admin.index'));
		$response->assertStatus(302);

    }

    
    public function test_category_index_page_renders()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);		
		
        $response = $this->get('admin/categories');
		$response->assertStatus(200);
        $response->assertSee('Categories');

    }


    public function test_category_add_page_renders()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);		
		
        $response = $this->get('admin/categories/create');
		$response->assertStatus(200);
        $response->assertSee('Add Category');

    }

    
    public function test_category_add_form_name_is_required()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);		
		
        $response = $this->from('admin/categories/create')->post('admin/categories',[
            'name' => '',
        ]);

        // Should redirect back to the form
        $response->assertRedirect('admin/categories/create');

         // Assert validation error for 'name'
        $response->assertSessionHasErrors(['name']);
    }

    public function test_add_category_form_creates_category_with_valid_input()
    {
        // Optional: Simulate authenticated user
        // $user = User::factory()->create();
        // $this->actingAs($user);

        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // Simulate form input
        $formData = [
            'name' => 'Category 1',
        ];

        // Submit POST request to the category creation endpoint       
        $response = $this->post('admin/categories', $formData); 

        // Assert response status (e.g. redirect to category list)
        $response->assertRedirect('admin/categories'); 

        // Assert that the category is in the database
        $this->assertDatabaseHas('categories', [
            'name' => 'Category 1',
        ]);
    }
	
	
	public function test_subcategory_index_page_renders()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);		
		
        $response = $this->get('admin/subcategories');
		$response->assertStatus(200);
        $response->assertSee('Subcategories');

    }
	
	
	public function test_subcategory_add_page_renders()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);		
		
        $response = $this->get('admin/subcategories/create');
		$response->assertStatus(200);
        $response->assertSee('Add Subcategory');

    }
	
	
	public function test_subcategory_add_form_name_is_required()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);	

        $category_id = $this->add_category_return_id();
		
        $response = $this->from('admin/subcategories/create')->post('admin/subcategories',[
            'name' => '',
            'category_id' => $category_id,
        ]);

        // Should redirect back to the form
        $response->assertRedirect('admin/subcategories/create');

         // Assert validation error for 'name'
        $response->assertSessionHasErrors(['name']);
    }
	
	
	public function test_subcategory_add_form_category_is_required()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);	

        $category_id = $this->add_category_return_id();
		
        $response = $this->from('admin/subcategories/create')->post('admin/subcategories',[
            'name' => 'Subcategory 1',
            'category_id' => '',
        ]);

        // Should redirect back to the form
        $response->assertRedirect('admin/subcategories/create');

         // Assert validation error for 'name'
        $response->assertSessionHasErrors(['category_id']);
    }
	
	
	public function test_subcategory_add_form_category_works_with_valid_data()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminMiddleware::class,
        ]);	

		$categoryId = $this->add_category_return_id();
		
        $response = $this->from('admin/subcategories/create')->post('admin/subcategories',[
            'name' => 'Subcategory 1',
			'category_id' => $categoryId,
        ]);

        // Should redirect back to the form
        $response->assertRedirect('admin/subcategories');
		
		// Assert that the category is in the database
        $this->assertDatabaseHas('subcategories', [
            'name' => 'Subcategory 1',
        ]);
    }

		
	public function test_childcategory_index_page_renders()
	{
		$this->withoutMiddleware([
			\App\Http\Middleware\AdminMiddleware::class,
		]);		
		
		$response = $this->get('admin/childcategories');
		$response->assertStatus(200);
		$response->assertSee('Child Categories');

	}


	public function test_childcategory_add_page_renders()
	{
		$this->withoutMiddleware([
			\App\Http\Middleware\AdminMiddleware::class,
		]);		
		
		$response = $this->get('admin/childcategories/create');
		$response->assertStatus(200);
		$response->assertSee('Add child category');

	}


	public function test_childcategory_add_form_name_is_required()
	{
		$this->withoutMiddleware([
			\App\Http\Middleware\AdminMiddleware::class,
		]);	
		
		$categoryId = $this->add_category_return_id();		
		$subcategoryId = $this->add_subcategory_return_id($categoryId);
		
		$response = $this->from('admin/childcategories/create')->post('admin/childcategories',[
			'name' => '',
			'subcategory_id' => $subcategoryId,
		]);

		// Should redirect back to the form
		$response->assertRedirect('admin/childcategories/create');

		 // Assert validation error for 'name'
		$response->assertSessionHasErrors(['name']);
	}


	public function test_childcategory_add_form_subcategory_is_required()
	{
		$this->withoutMiddleware([
			\App\Http\Middleware\AdminMiddleware::class,
		]);	
		
		$categoryId = $this->add_category_return_id();		
		$subcategoryId = $this->add_subcategory_return_id($categoryId);
		
		$response = $this->from('admin/childcategories/create')->post('admin/childcategories',[
			'name' => 'test',
			'subcategory_id' => NULL,
		]);	

		// Should redirect back to the form
		$response->assertRedirect('admin/childcategories/create');

		 // Assert validation error for 'name'
		$response->assertSessionHasErrors(['subcategory_id']);
	}


	public function test_childcategory_add_form_category_works_with_valid_data()
	{
		$this->withoutMiddleware([
			\App\Http\Middleware\AdminMiddleware::class,
		]);	
		
		$categoryId = $this->add_category_return_id();
		$subcategoryId = $this->add_subcategory_return_id($categoryId);
		
		$response = $this->from('admin/childcategories/create')->post('admin/childcategories',[
			'name' => 'Child Category 1',
			'subcategory_id' => $subcategoryId,
		]);
		
		// Should redirect back to the form
		$response->assertRedirect('admin/childcategories');
		
		// Assert that the category is in the database
		$this->assertDatabaseHas('childcategories', [
			'name' => 'Child Category 1',
		]);
	}
}
 