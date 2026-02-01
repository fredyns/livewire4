# Testing

source: https://livewire.laravel.com/docs/4.x/testingLivewire components are simple to test. Because they are just Laravel classes under the hood, they can be tested using Laravel's existing testing tools. Livewire also provides additional utilities to make testing your components easier.This guide uses Pest as the recommended framework, though PHPUnit works too.#

# Installing PestPest is the recommended way to test Livewire components in Livewire 4.

```

bashcomposer remove phpunit/phpunitcomposer require pestphp/pest --dev --with-all-dependencies

```

Initialize Pest:

```

bash./vendor/bin/pest --init

```

This will create `tests/Pest.php`.#

# Configuring Pest for view-based componentsIf you write tests alongside view-based components (single-file or multi-file), configure Pest to include `resources/views`.Update `tests/Pest.php`:

```

phppest()    ->extend(Tests\TestCase::class)    // ...    ->in('Feature', '../resources/views');

```

Update `phpunit.xml` to include a suite for component tests:

```

xml<testsuite name="Components">    <directory suffix=".test.php">resources/views</directory></testsuite>

```

#

# Creating your first testGenerate a test file next to a component with `--test`:

```

bashphp artisan make:livewire post.create --test

```

For multi-file components, this creates:

```

textresources/views/components/post/create.test.php

```

Example:

```

php<?phpuse Livewire\Livewire;it('renders successfully', function () {    Livewire::test('post.create')        ->assertStatus(200);});

```

#

# Testing a page contains a componentA simple smoke test:

```

phpit('component exists on the page', function () {    $this->get('/posts/create')        ->assertSeeLivewire('post.create');});

```

#

# Browser testingPest v4 includes browser testing support powered by Playwright.

##

# Installing browser testing

```

bashcomposer require pestphp/pest-plugin-browser --devnpm install playwright@latestnpx playwright install

```

##

# Writing browser testsUse `Livewire::visit()`:

```

phpit('can create a new post', function () {    Livewire::visit('post.create')        ->type('[wire\:model="title"]', 'My first post')        ->type('[wire\:model="content"]', 'This is the content')        ->press('Save')        ->assertSee('Post created successfully');});

```

Browser tests are slower but provide end-to-end confidence.#

# Testing views

##

# Asserting view data

```

phpuse App\Models\Post;it('passes all posts to the view', function () {    Post::factory()->count(3)->create();    Livewire::test('show-posts')        ->assertViewHas('posts', function ($posts) {            return count($posts) === 3;        });});

```

For simple assertions:

```

phpLivewire::test('show-posts')    ->assertViewHas('postCount', 3);

```

#

# Testing with authenticationUse `actingAs()`:

```

phpuse App\Models\Post;use App\Models\User;it('user only sees their own posts', function () {    $user = User::factory()        ->has(Post::factory()->count(3))        ->create();    $stranger = User::factory()        ->has(Post::factory()->count(2))        ->create();    Livewire::actingAs($user)        ->test('show-posts')        ->assertViewHas('posts', function ($posts) {            return count($posts) === 3;        });});

```

#

# Testing properties

##

# Initializing propertiesPass initial data as the second argument to `Livewire::test()`:

```

phpuse App\Models\Post;it('title field is populated when editing', function () {    $post = Post::factory()->create([        'title' => 'Existing post title',    ]);    Livewire::test('post.edit', ['post' => $post])        ->assertSet('title', 'Existing post title');});

```

##

# Setting URL parametersUse `withQueryParams()`:

```

phpuse App\Models\Post;it('can search posts via url query string', function () {    Post::factory()->create(['title' => 'Laravel testing']);    Post::factory()->create(['title' => 'Vue components']);    Livewire::withQueryParams(['search' => 'Laravel'])        ->test('search-posts')        ->assertSee('Laravel testing')        ->assertDontSee('Vue components');});

```

##

# Setting cookiesUse `withCookie()` / `withCookies()`:

```

phpit('loads discount token from cookie', function () {    Livewire::withCookies(['discountToken' => 'SUMMER2024'])        ->test('cart')        ->assertSet('discountToken', 'SUMMER2024');});

```

#

# Calling actionsUse `call()`:

```

phpuse App\Models\Post;it('can create a post', function () {    expect(Post::count())->toBe(0);    Livewire::test('post.create')        ->set('title', 'My new post')        ->set('content', 'Post content here')        ->call('save');    expect(Post::count())->toBe(1);});

```

Call with parameters:

```

phpLivewire::test('post.show')    ->call('deletePost', $postId);

```

#

# Testing validationUse `assertHasErrors()`:

```

phpit('title field is required', function () {    Livewire::test('post.create')        ->set('title', '')        ->call('save')        ->assertHasErrors('title');});

```

Test specific rules:

```

phpit('title must be at least 3 characters', function () {    Livewire::test('post.create')        ->set('title', 'ab')        ->call('save')        ->assertHasErrors(['title' => ['min:3']]);});

```

#

# Testing authorizationUse `assertUnauthorized()` and `assertForbidden()`:

```

phpuse App\Models\Post;use App\Models\User;it('cannot update another users post', function () {    $user = User::factory()->create();    $stranger = User::factory()->create();    $post = Post::factory()->for($stranger)->create();    Livewire::actingAs($user)        ->test('post.edit', ['post' => $post])        ->set('title', 'Hacked!')        ->call('save')        ->assertForbidden();});

```

#

# Testing redirects

```

phpit('redirects to posts index after creating', function () {    Livewire::test('post.create')        ->set('title', 'New post')        ->set('content', 'Content here')        ->call('save')        ->assertRedirect('/posts');});

```

Also:

```

php->assertRedirect(route('posts.index'));->assertRedirectToRoute('posts.index');

```

#

# Testing eventsAssert dispatch:

```

phpit('dispatches event when post is created', function () {    Livewire::test('post.create')        ->set('title', 'New post')        ->call('save')        ->assertDispatched('post-created');});

```

Test component-to-component communication:

```

phpit('updates post count when event is dispatched', function () {    $badge = Livewire::test('post-count-badge')        ->assertSee('0');    Livewire::test('post.create')        ->set('title', 'New post')        ->call('save')        ->assertDispatched('post-created');    $badge->dispatch('post-created')        ->assertSee('1');});

```

#

# Using PHPUnitYou can use PHPUnit with the same Livewire testing APIs.#

# See also- [Actions](actions.md) — Test component actions and interactions- [Forms](forms.md) — Test form submissions and validation- [Events](events.md) — Test event dispatching and listening- [Components](components.md) — Create testable component structure
