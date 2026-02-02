# Testing

source: https://livewire.laravel.com/docs/4.x/testing

Livewire components are simple to test. Because they are just Laravel classes under the hood, they can be tested using Laravel's existing testing tools. Livewire also provides additional utilities to make testing your components easier.

This guide uses Pest as the recommended framework, though PHPUnit works too.

#

# Installing Pest

Pest is the recommended way to test Livewire components in Livewire 4.



```

bashcomposer remove phpunit/phpunitcomposer require pestphp/pest --dev --with-all-dependencies

```



Initialize Pest:



```

bash./vendor/bin/pest --init

```



This will create `tests/Pest.php`.

#

# Configuring Pest for view-based components

If you write tests alongside view-based components (single-file or multi-file), configure Pest to include `resources/views`.Update `tests/Pest.php`:



```php
pest()    ->extend(Tests\TestCase::class)    // ...    ->in('Feature', '../resources/views');

```



Update `phpunit.xml` to include a suite for component tests:



```

xml<testsuite name="Components">    <directory suffix=".test.php">resources/views</directory></testsuite>

```



#

# Creating your first test

Generate a test file next to a component with `--test`:



```

bashphp artisan make:livewire post.create --test

```



For multi-file components, this creates:



```text
resources/views/components/post/create.test.php

```



Example:



```php
<?phpuse Livewire\Livewire;it('renders successfully', function () {    Livewire::test('post.create')        ->assertStatus(200);});

```



#

# Testing a page contains a component

A simple smoke test:



```php
it('component exists on the page', function () {    $this->get('/posts/create')        ->assertSeeLivewire('post.create');});

```



#

# Browser testing

Pest v4 includes browser testing support powered by Playwright.

#

#

# Installing browser testing



```

bashcomposer require pestphp/pest-plugin-browser --devnpm install playwright@latestnpx playwright install

```



#

#

# Writing browser tests

Use `Livewire::visit()`:



```php
it('can create a new post', function () {    Livewire::visit('post.create')        ->type('[wire\:model="title"]', 'My first post')        ->type('[wire\:model="content"]', 'This is the content')        ->press('Save')        ->assertSee('Post created successfully');});

```



Browser tests are slower but provide end-to-end confidence.

#

# Testing views

#

#

# Asserting view data



```php
use App\Models\Post;it('passes all posts to the view', function () {    Post::factory()->count(3)->create();    Livewire::test('show-posts')        ->assertViewHas('posts', function ($posts) {            return count($posts) === 3;        });});

```



For simple assertions:



```php
Livewire::test('show-posts')    ->assertViewHas('postCount', 3);

```



#

# Testing with authentication

Use `actingAs()`:



```php
use App\Models\Post;use App\Models\User;it('user only sees their own posts', function () {    $user = User::factory()        ->has(Post::factory()->count(3))        ->create();    $stranger = User::factory()        ->has(Post::factory()->count(2))        ->create();    Livewire::actingAs($user)        ->test('show-posts')        ->assertViewHas('posts', function ($posts) {            return count($posts) === 3;        });});

```



#

# Testing properties

#

#

# Initializing properties

Pass initial data as the second argument to `Livewire::test()`:



```php
use App\Models\Post;it('title field is populated when editing', function () {    $post = Post::factory()->create([        'title' => 'Existing post title',    ]);    Livewire::test('post.edit', ['post' => $post])        ->assertSet('title', 'Existing post title');});

```



#

#

# Setting URL parameters

Use `withQueryParams()`:



```php
use App\Models\Post;it('can search posts via url query string', function () {    Post::factory()->create(['title' => 'Laravel testing']);    Post::factory()->create(['title' => 'Vue components']);    Livewire::withQueryParams(['search' => 'Laravel'])        ->test('search-posts')        ->assertSee('Laravel testing')        ->assertDontSee('Vue components');});

```



#

#

# Setting cookies

Use `withCookie()` / `withCookies()`:



```php
it('loads discount token from cookie', function () {    Livewire::withCookies(['discountToken' => 'SUMMER2024'])        ->test('cart')        ->assertSet('discountToken', 'SUMMER2024');});

```



#

# Calling actions

Use `call()`:



```php
use App\Models\Post;it('can create a post', function () {    expect(Post::count())->toBe(0);    Livewire::test('post.create')        ->set('title', 'My new post')        ->set('content', 'Post content here')        ->call('save');    expect(Post::count())->toBe(1);});

```



Call with parameters:



```php
Livewire::test('post.show')    ->call('deletePost', $postId);

```



#

# Testing validation

Use `assertHasErrors()`:



```php
it('title field is required', function () {    Livewire::test('post.create')        ->set('title', '')        ->call('save')        ->assertHasErrors('title');});

```



Test specific rules:



```php
it('title must be at least 3 characters', function () {    Livewire::test('post.create')        ->set('title', 'ab')        ->call('save')        ->assertHasErrors(['title' => ['min:3']]);});

```



#

# Testing authorization

Use `assertUnauthorized()` and `assertForbidden()`:



```php
use App\Models\Post;use App\Models\User;it('cannot update another users post', function () {    $user = User::factory()->create();    $stranger = User::factory()->create();    $post = Post::factory()->for($stranger)->create();    Livewire::actingAs($user)        ->test('post.edit', ['post' => $post])        ->set('title', 'Hacked!')        ->call('save')        ->assertForbidden();});

```



#

# Testing redirects



```php
it('redirects to posts index after creating', function () {    Livewire::test('post.create')        ->set('title', 'New post')        ->set('content', 'Content here')        ->call('save')        ->assertRedirect('/posts');});

```



Also:



```php
->assertRedirect(route('posts.index'));->assertRedirectToRoute('posts.index');

```



#

# Testing events

Assert dispatch:



```php
it('dispatches event when post is created', function () {    Livewire::test('post.create')        ->set('title', 'New post')        ->call('save')        ->assertDispatched('post-created');});

```



Test component-to-component communication:



```php
it('updates post count when event is dispatched', function () {    $badge = Livewire::test('post-count-badge')        ->assertSee('0');    Livewire::test('post.create')        ->set('title', 'New post')        ->call('save')        ->assertDispatched('post-created');    $badge->dispatch('post-created')        ->assertSee('1');});

```



#

# Using PHPUnit

You can use PHPUnit with the same Livewire testing APIs.

#

# See also
- [Actions](actions.md) Ã¢â‚¬â€ Test component actions and interactions- [Forms](forms.md) Ã¢â‚¬â€ Test form submissions and validation- [Events](events.md) Ã¢â‚¬â€ Test event dispatching and listening- [Components](components.md) Ã¢â‚¬â€ Create testable component structure
