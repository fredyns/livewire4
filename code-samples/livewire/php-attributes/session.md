# Session

source: https://livewire.laravel.com/docs/4.x/attribute-sessionThe `#[Session]` attribute persists a property's value in the user's session, maintaining it across page refreshes and navigation.#

# Basic usageApply the `#[Session]` attribute to any property that should persist in the session:

```

php<?php// resources/views/components/post/⚡index.blade.phpuse Livewire\Attributes\Session;use Livewire\Attributes\Computed;use Livewire\Component;use App\Models\Post;new class extends Component {    #[Session]    public $search = '';    #[Computed]    public function posts()    {        return $this->search === ''            ? Post::all()            : Post::where('title', 'like', "%{$this->search}%")->get();    }};?><div>    <input type="text" wire:model.live="search" placeholder="Search posts...">    @foreach($this->posts as $post)        <div wire:key="{{ $post->id }}">{{ $post->title }}</div>    @endforeach</div>

```

After a user enters a search value, they can refresh the page or navigate away and return — the search value will be preserved.#

# How it worksEvery time the property changes, Livewire stores its new value in the user's session.When the component loads, Livewire fetches the value from the session and initializes the property with it.This creates a persistent user experience without modifying the URL.#

# Session vs URLBoth `#[Session]` and `#[Url]` persist property values, but with different trade-offs.Use `#[Session]` when you want persistence without cluttering the URL or when state shouldn't be shareable.#

# Custom session keysBy default, Livewire generates session keys using the component and property names.You can customize this:

```

php<?php// resources/views/components/post/⚡index.blade.phpuse Livewire\Attributes\Session;use Livewire\Component;new class extends Component {    #[Session(key: 'post_search')]    public $search = '';};

```

The property will be stored in the session using the key `post_search`.#

# Dynamic session keysYou can generate keys dynamically using other properties:

```

php<?php// resources/views/components/post/⚡index.blade.phpuse Livewire\Attributes\Session;use Livewire\Component;use App\Models\Author;new class extends Component {    public Author $author;    #[Session(key: 'search-{author.id}')]    public $search = '';};

```

If `$author->id` is `4`, the session key becomes `search-4`.#

# When to useUse `#[Session]` when:- Persisting user preferences (theme, language, sidebar state)- Maintaining filter/search state across page navigation- Storing form data to prevent loss on refresh- Keeping UI state private to the user- Avoiding URL clutter from query parameters#

# Example: Dashboard filters

```

php<?php// resources/views/pages/⚡dashboard.blade.phpuse Livewire\Attributes\Session;use Livewire\Attributes\Computed;use Livewire\Component;use App\Models\Transaction;new class extends Component {    #[Session]    public $dateRange = '30days';    #[Session]    public $category = 'all';    #[Session]    public $sortBy = 'date';    #[Computed]    public function transactions()    {        return Transaction::query()            ->when($this->dateRange === '30days', fn($q) => $q->where('created_at', '>=', now()->subDays(30)))            ->when($this->category !== 'all', fn($q) => $q->where('category', $this->category))            ->orderBy($this->sortBy)            ->get();    }};?><div>    <select wire:model.live="dateRange">        <option value="7days">Last 7 days</option>        <option value="30days">Last 30 days</option>        <option value="year">This year</option>    </select>    <select wire:model.live="category">        <option value="all">All categories</option>        <option value="income">Income</option>        <option value="expense">Expense</option>    </select>    <select wire:model.live="sortBy">        <option value="date">Date</option>        <option value="amount">Amount</option>    </select>    @foreach($this->transactions as $transaction)        <div wire:key="{{ $transaction->id }}">{{ $transaction->description }}</div>    @endforeach</div>

```

Users can set their preferred filters and they'll persist across sessions, page refreshes, and navigation.#

# Performance considerationsLaravel sessions are loaded into memory during every request.Storing too much in a user's session can slow down your entire application for that user.Avoid storing large collections or objects.Good uses:- Simple values (strings, numbers, booleans)- Small arrays (filter options, preferences)- Model IDs (not entire models)Bad uses:- Large collections- Complete Eloquent models- Binary data or file contentsIf you want state to be shareable via URL or bookmarkable, consider using the `#[Url]` attribute instead of `#[Session]`.#

# Reference

```

text#[Session(    ?string $key = null,)]

```
